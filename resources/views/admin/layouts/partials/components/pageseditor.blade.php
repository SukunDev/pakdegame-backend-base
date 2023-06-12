<form method="POST" action="/ngadmin/pages/{{ $type == 'write' ? 'write' : 'change/' . $pages['slug'] }}"
    enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-6 gap-4">
        <div class="flex flex-col col-span-4 space-y-4">
            <div class="flex flex-col space-y-1">
                <label class="font-medium capitalize" for="titleForm">Title</label>
                <input
                    class="px-4 py-2 transition duration-300 bg-gray-100 border ro unded-lg focus:outline-none hover:bg-gray-200 focus:bg-gray-100"
                    type="text" name="title" id="titleForm"
                    value="{{ $type == 'write' ? old('title') : $pages['title'] }}" required>
            </div>
            <div id="permalink" class="flex items-center px-1" style="display: {{ $type == 'write' ? 'none' : '' }};">
                <p class="font-medium line-clamp-1">Permalink: <span
                        class="font-normal text-blue-500 cursor-pointer hover:underline">{{ env('APP_URL') }}/{{ $type == 'write' ? '' : $pages['slug'] }}</span>
                </p>
                <div id="edit-permalink" class="flex items-end" style="display: none">
                    <input
                        class="px-4 py-1 transition duration-300 bg-gray-200 rounded-md focus:outline-gray-200 focus:bg-white focus:shadow-md"
                        type="text" name="slug" id="slugForm"
                        value="{{ $type == 'write' ? old('slug') : $pages['slug'] }}" required>
                    <button id="permalink-ok"
                        class="ml-2 px-1.5 py-1.5 text-sm rounded-md bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300 text-white"
                        type="button">OK</button>
                    <button id="permalink-cancel" class="ml-2 text-sm text-blue-500 hover:underline"
                        type="button">Cancel</button>
                </div>
                <button id="permalink-edit"
                    class="ml-2 px-1.5 py-1.5 text-sm rounded-md bg-blue-500 hover:bg-blue-600 active:bg-blue-500 transition duration-300 text-white"
                    type="button">Edit</button>
            </div>
            <div class="flex flex-col space-y-1">
                <label for="editor" class="font-medium capitalize">Content</label>
                <textarea name="body" id="editor">{{ $type == 'write' ? old('body') : $pages['body'] }}</textarea>
            </div>
        </div>
        <div class="flex flex-col col-span-2 space-y-4">
            <div class="flex items-end gap-4">
                <div class="flex flex-col flex-grow space-y-1">
                    <label class="font-medium text-gray-600 capitalize" for="status">status
                    </label>
                    <select
                        class="px-4 py-2 capitalize transition duration-300 bg-gray-100 border rounded-lg focus:outline-none hover:bg-gray-200 focus:bg-gray-100"
                        name="status" id="status">
                        <option class="capitalize" value="draft"
                            {{ $type == 'write' ? '' : (empty($pages['published_at']) ? 'selected' : '') }}>draft
                        </option>
                        <option class="capitalize" value="publish"
                            {{ $type == 'write' ? '' : (empty($pages['published_at']) ? '' : 'selected') }}>publish
                        </option>
                    </select>
                </div>
                <button type="submit"
                    class="px-4 py-2 text-white transition duration-300 bg-green-500 rounded-md hover:bg-green-400 active:bg-green-500">
                    submit
                </button>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var permalinkSlug = ""
        $('#titleForm').on('change', function() {
            fetch('/blog/page/check-slug?title=' + $(this).val())
                .then(response => response.json())
                .then(function(data) {
                    permalinkSlug = data.slug
                    $('#slugForm').val(permalinkSlug)
                    var permalink = $('#permalink')
                    permalink.find('span').text(
                        "{{ env('APP_URL') }}/" +
                        permalinkSlug)
                    permalink.show()
                })
        });
        $('#permalink-edit').on('click', function() {
            $('#edit-permalink').show()
            $(this).hide()
            var permalink = $('#permalink')
            permalink.find('span').text(
                "{{ env('APP_URL') }}/")
        })
        $('#permalink-ok').on('click', function() {
            permalinkSlug = $('#slugForm').val()
            var permalink = $('#permalink')
            permalink.find('span').text(
                "{{ env('APP_URL') }}/" +
                permalinkSlug
            )
            $('#edit-permalink').hide()
            $('#permalink-edit').show()
        })
        $('#permalink-cancel').on('click', function() {
            var permalink = $('#permalink')
            $('#slugForm').val(permalinkSlug)
            permalink.find('span').text(
                "{{ env('APP_URL') }}/" +
                permalinkSlug
            )
            $('#edit-permalink').hide()
            $('#permalink-edit').show()
        })
        var content = CKEDITOR.replace('editor', {
            filebrowserImageBrowseUrl: '/ngadmin/pages/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/ngadmin/pages/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/ngadmin/pages/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/ngadmin/pages/laravel-filemanager/upload?type=Files&_token='
        });
    })
</script>
