<form method="POST" action="/ngadmin/posts/{{ $type == 'write' ? 'write' : 'change/' . $posts['slug'] }}"
    enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-6 gap-4">
        <div class="flex flex-col col-span-4 space-y-4">
            <div class="flex flex-col space-y-1">
                <label class="font-medium capitalize" for="titleForm">Title</label>
                <input
                    class="px-4 py-2 transition duration-300 bg-gray-100 border ro unded-lg focus:outline-none hover:bg-gray-200 focus:bg-gray-100"
                    type="text" name="title" id="titleForm"
                    value="{{ $type == 'write' ? old('title') : $posts['title'] }}" required>
            </div>
            <div id="permalink" class="flex items-center px-1" style="display: {{ $type == 'write' ? 'none' : '' }};">
                <p class="font-medium line-clamp-1">Permalink: <span
                        class="font-normal text-blue-500 cursor-pointer hover:underline">{{ env('APP_URL') }}/{{ $type == 'write' ? '' : $posts['slug'] }}</span>
                </p>
                <div id="edit-permalink" class="flex items-end" style="display: none">
                    <input
                        class="px-4 py-1 transition duration-300 bg-gray-200 rounded-md focus:outline-gray-200 focus:bg-white focus:shadow-md"
                        type="text" name="slug" id="slugForm"
                        value="{{ $type == 'write' ? old('slug') : $posts['slug'] }}" required>
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
                <textarea name="body" id="editor">{{ $type == 'write' ? old('body') : $posts['body'] }}</textarea>
            </div>
            <div class="flex flex-col space-y-1">
                <label class="font-medium capitalize" for="metaDiscriptionForm">meta description</label>
                <textarea
                    class="px-4 py-2 transition duration-300 bg-gray-100 border ro unded-lg focus:outline-none hover:bg-gray-200 focus:bg-gray-100"
                    name="meta_description" id="metaDiscriptionForm" rows="4">{{ $type == 'write' ? old('meta_description') : $posts['meta_description'] }}</textarea>
                <div id="the-count" class="flex justify-end gap-1">
                    <span id="current">0</span>
                    <span id="maximum">/ 160</span>
                </div>
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
                            {{ $type == 'write' ? '' : (empty($posts['published_at']) ? 'selected' : '') }}>draft
                        </option>
                        <option class="capitalize" value="publish"
                            {{ $type == 'write' ? '' : (empty($posts['published_at']) ? '' : 'selected') }}>publish
                        </option>
                    </select>
                </div>
                <button type="submit"
                    class="px-4 py-2 text-white transition duration-300 bg-green-500 rounded-md hover:bg-green-400 active:bg-green-500">
                    submit
                </button>
            </div>
            <div class="flex flex-col">
                <label class="font-medium capitalize" for="categoryForm">Category</label>
                <select
                    class="px-4 py-2 capitalize transition duration-300 bg-gray-100 border ro unded-lg focus:outline-none hover:bg-gray-200 focus:bg-gray-100"
                    name="category_id" id="categoryForm">
                    <option class="capitalize" value="">Pilih Kategory
                    </option>
                    @foreach ($categories as $category)
                        <option class="capitalize" value="{{ $category['id'] }}"
                            {{ $type == 'write' ? (old('category_id') == $category['id'] ? 'selected' : '') : ($posts['category_id'] == $category['id'] ? 'selected' : '') }}>
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col space-y-1">
                <label class="font-medium text-gray-600 capitalize" for="tags">
                    tags
                </label>
                <input
                    class="px-4 py-2 transition duration-300 bg-gray-100 border ro unded-lg focus:outline-none hover:bg-gray-200 focus:bg-gray-100"
                    type="text" name="tags" id="tags"
                    value="{{ $type == 'write' ? old('tags') : $posts['meta_keyword'] }}">
            </div>
            <div class="flex flex-col space-y-1">
                <p class="font-medium capitalize">thumbnail</p>
                <label
                    class="relative w-full h-64 border-2 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                    <div id="tempat-gambar"
                        class="absolute {{ $type == 'write' ? '' : 'hidden' }} inset-0 m-auto h-fit w-fit">
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                Attach a file</p>
                        </div>
                    </div>
                    <img class="absolute inset-0 {{ $type == 'write' ? 'hidden' : '' }} object-contain w-full m-auto h-60"
                        id="output" src="{{ $type == 'write' ? '' : $posts['thumbnail'] }}" />
                    <input type="file" class="opacity-0" name="thumbnail" onchange="loadFile(event)" />
                </label>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    var loadFile = function(event) {
        var reader = new FileReader();
        var tempat_gambar = document.getElementById('tempat-gambar');
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        output.style.display = "block";
        tempat_gambar.style.display = "none";
        reader.readAsDataURL(event.target.files[0]);
    };
    $(document).ready(function() {
        var permalinkSlug = ""
        $('#titleForm').on('change', function() {
            fetch('/blog/check-slug?title=' + $(this).val())
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
            filebrowserImageBrowseUrl: '/ngadmin/posts/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/ngadmin/posts/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/ngadmin/posts/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/ngadmin/posts/laravel-filemanager/upload?type=Files&_token='
        });
        $('#metaDiscriptionForm').keyup(function() {
            metaCharacterCount()
        });
        metaCharacterCount()
    })

    function metaCharacterCount() {
        var characterCount = $('#metaDiscriptionForm').val().length,
            current = $('#current'),
            maximum = $('#maximum'),
            theCount = $('#the-count');
        current.text(characterCount);
        /*This isn't entirely necessary, just playin around*/
        if (characterCount < 100) {
            current.css('color', '#666');
            maximum.css('color', '#666');
            theCount.css('font-weight', 'normal');
        }
        if (characterCount > 100 && characterCount < 145) {
            current.css('color', 'rgb(234 179 8 / 1)');
            theCount.css('font-weight', 'normal');
        }
        if (characterCount > 145 && characterCount < 155) {
            current.css('color', 'rgb(34 197 94 / 1)');
            maximum.css('color', '#666');
            theCount.css('font-weight', 'normal');
        }
        if (characterCount > 155 && characterCount <= 160) {
            current.css('color', 'rgb(34 197 94 / 1)');
            maximum.css('color', 'rgb(34 197 94 / 1)');
            theCount.css('font-weight', 'bold');
        }
        if (characterCount > 160) {
            current.css('color', '#8f0001');
            maximum.css('color', '#8f0001');
            theCount.css('font-weight', 'bold');
        }
    }
</script>
