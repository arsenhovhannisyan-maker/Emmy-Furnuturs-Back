<x-dashboard.layouts.app>
    <div class="container-fluid">
        <div class="card mb-4">
             <x-dashboard.form._form
                :action="$viewMode === 'add' ? route('dashboard.blogs.store') : route('dashboard.blogs.update', $blog->id)"
                :method="$viewMode === 'add' ? 'post' : 'put'"
                :indexUrl="route('dashboard.blogs.index')"
                :viewMode="$viewMode"
            >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group required">
                            <x-dashboard.form._input name="name" :value="$blog->name"/>
                        </div>

                        <div class="form-group required">
                            <x-dashboard.form._textarea name="description"  :value="$blog->description"
                            />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group ">
                            <x-dashboard.form._textarea name="shortDescription" :value="$blog->shortDescription" :rows="4"/>
                            <br>
                            <br>
                            <x-dashboard.form._checkbox
                                name="is_active"
                                :checked="$blog->is_active ?? 0"
                                title="Is Active"
                            />
                            <br>
                            <br>
                            <div class="form-group">
                                <x-dashboard.form.uploader._file
                                    name="photo"
                                    :value="$blog->photo ?? null"
                                    :configKey="$blog->getFileConfigName()"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </x-dashboard.form._form>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('/js/dashboard/blog/main.js') }}"></script>
    </x-slot>
</x-dashboard.layouts.app>


