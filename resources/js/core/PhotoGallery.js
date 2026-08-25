// Drag-and-drop multi-photo gallery used on the product form: one instance per
// product size. Replaces the old fixed photo1..photo48 slot system - photos are
// dropped/selected together, previewed immediately, reordered by dragging (order
// = position in the DOM), and removed with a single click. Nothing is deleted on
// the server until the product form is actually saved.
(function () {
  function buildThumb(kind, value, imgUrl, isPending) {
    const thumb = document.createElement('div');
    thumb.className = 'photo-thumb' + (isPending ? ' is-pending' : '');
    thumb.draggable = true;
    thumb.dataset.kind = kind;
    thumb.dataset.value = value || '';
    thumb.innerHTML = `
            <img src="${imgUrl}" alt="">
            <div class="photo-thumb-spinner"><div class="spinner-border spinner-border-sm text-light"></div></div>
            <button type="button" class="photo-thumb-remove" title="Удалить"><i class="fas fa-times"></i></button>
        `;
    return thumb;
  }

  function getDragAfterElement(grid, x, y, dragging) {
    const thumbs = [...grid.querySelectorAll('.photo-thumb')].filter((el) => el !== dragging);
    let closest = null;
    let closestDistance = Infinity;
    let after = true;

    thumbs.forEach((el) => {
      const box = el.getBoundingClientRect();
      const centerX = box.left + box.width / 2;
      const centerY = box.top + box.height / 2;
      const distance = Math.hypot(x - centerX, y - centerY);
      if (distance < closestDistance) {
        closestDistance = distance;
        closest = el;
        after = x > centerX;
      }
    });

    if (!closest) return null;

    return after ? closest.nextElementSibling : closest;
  }

  function initPhotoGallery(galleryEl, existingPhotos = []) {
    if (!galleryEl || galleryEl.dataset.initialized) return;
    galleryEl.dataset.initialized = '1';

    const grid = galleryEl.querySelector('.photo-gallery-grid');
    const fileInput = galleryEl.querySelector('.photo-dropzone-input');
    const dropzone = galleryEl.querySelector('.photo-dropzone');
    const hiddenBox = galleryEl.querySelector('.photo-gallery-hidden-inputs');
    const errorBox = galleryEl.querySelector('.photo-gallery-error');
    const configKey = galleryEl.dataset.configKey;
    const maxPhotos = parseInt(galleryEl.dataset.max || '20', 10);

    let draggedThumb = null;

    function serialize() {
      hiddenBox.innerHTML = '';
      const rowIndex = galleryEl.closest('.size-row').dataset.rowIndex;
      grid.querySelectorAll('.photo-thumb').forEach((thumb) => {
        if (!thumb.dataset.value || thumb.classList.contains('is-pending')) return;
        const field = thumb.dataset.kind === 'existing' ? 'existing_photos' : 'new_photos';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `sizes[${rowIndex}][${field}][]`;
        input.value = thumb.dataset.value;
        hiddenBox.appendChild(input);
      });
    }

    function showError(message) {
      if (!errorBox) return;
      errorBox.textContent = message;
      errorBox.style.display = message ? 'block' : 'none';
    }

    function currentCount() {
      return grid.querySelectorAll('.photo-thumb').length;
    }

    function uploadFile(file) {
      if (currentCount() >= maxPhotos) {
        showError(`Максимум ${maxPhotos} фото на размер`);
        return;
      }

      const reader = new FileReader();
      reader.onload = (e) => {
        const thumb = buildThumb('new', '', e.target.result, true);
        grid.appendChild(thumb);

        const formData = new FormData();
        formData.append('file', file);
        formData.append('config_key', configKey);

        // eslint-disable-next-line no-undef
        axios.post(route('dashboard.files.storeTempFile'), formData)
          .then((resp) => {
            thumb.classList.remove('is-pending');
            thumb.dataset.value = resp.data.name;
            serialize();
          })
          .catch((error) => {
            thumb.remove();
            const message = error.response?.data?.errors?.file?.[0] || 'Не удалось загрузить фото';
            showError(message);
          });
      };
      reader.readAsDataURL(file);
    }

    function handleFiles(fileList) {
      showError('');
      Array.from(fileList).forEach(uploadFile);
    }

    fileInput.addEventListener('change', () => {
      handleFiles(fileInput.files);
      fileInput.value = '';
    });

    ['dragenter', 'dragover'].forEach((evt) => {
      dropzone.addEventListener(evt, (e) => {
        if (!e.dataTransfer.types.includes('Files')) return;
        e.preventDefault();
        dropzone.classList.add('is-dragover');
      });
    });

    ['dragleave', 'drop'].forEach((evt) => {
      dropzone.addEventListener(evt, () => dropzone.classList.remove('is-dragover'));
    });

    dropzone.addEventListener('drop', (e) => {
      if (!e.dataTransfer.types.includes('Files')) return;
      e.preventDefault();
      handleFiles(e.dataTransfer.files);
    });

    grid.addEventListener('click', (e) => {
      const removeBtn = e.target.closest('.photo-thumb-remove');
      if (!removeBtn) return;
      removeBtn.closest('.photo-thumb').remove();
      serialize();
    });

    grid.addEventListener('dragstart', (e) => {
      const thumb = e.target.closest('.photo-thumb');
      if (!thumb) return;
      draggedThumb = thumb;
      e.dataTransfer.effectAllowed = 'move';
      setTimeout(() => thumb.classList.add('is-dragging'), 0);
    });

    grid.addEventListener('dragover', (e) => {
      if (!draggedThumb) return;
      e.preventDefault();
      const afterEl = getDragAfterElement(grid, e.clientX, e.clientY, draggedThumb);
      if (afterEl === draggedThumb) return;
      if (afterEl == null) grid.appendChild(draggedThumb);
      else grid.insertBefore(draggedThumb, afterEl);
    });

    grid.addEventListener('dragend', () => {
      if (draggedThumb) draggedThumb.classList.remove('is-dragging');
      draggedThumb = null;
      serialize();
    });

    existingPhotos.forEach((photo) => {
      grid.appendChild(buildThumb('existing', photo.id, photo.url, false));
    });
    serialize();
  }

  window.initPhotoGallery = initPhotoGallery;
  window.reserializePhotoGalleries = function reserializePhotoGalleries(scopeEl) {
    (scopeEl || document).querySelectorAll('.photo-gallery').forEach((galleryEl) => {
      const grid = galleryEl.querySelector('.photo-gallery-grid');
      const hiddenBox = galleryEl.querySelector('.photo-gallery-hidden-inputs');
      if (!grid || !hiddenBox) return;
      hiddenBox.innerHTML = '';
      const rowIndex = galleryEl.closest('.size-row').dataset.rowIndex;
      grid.querySelectorAll('.photo-thumb').forEach((thumb) => {
        if (!thumb.dataset.value || thumb.classList.contains('is-pending')) return;
        const field = thumb.dataset.kind === 'existing' ? 'existing_photos' : 'new_photos';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `sizes[${rowIndex}][${field}][]`;
        input.value = thumb.dataset.value;
        hiddenBox.appendChild(input);
      });
    });
  };
}());
