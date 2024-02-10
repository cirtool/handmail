@php $fileInputId = $this->id . '--fileInput' @endphp
<div 
    class="relative flex items-center justify-center w-full"
    x-data="{ 
        file: null,
        fileSize: 0,
        fileMimeType: null,
        isUploading: false, 
        progress: 0,
        preview: null,
        error: null,
        fromStorage: {{ $fileUrl ? 'true' : 'false' }},
        upload(file) {
            this.file = file;
            this.fileSize = file.size;
            this.fileMimeType = file.type;

            this.isUploading = true;
            this.tryToSetPreview();

            @this.upload('file', file, (uploadedFilename) => {
                this.isUploading = false;
            }, () => {
                this.file = null;
                this.isUploading = false;
                this.clearFileInput();
            }, (event) => {
                this.progress = event.detail.progress;
            });
        },
        tryToSetPreview() {
            if (/\.(jpe?g|png|gif|webp)$/i.test(this.file.name)) {
                const reader = new FileReader();

                reader.addEventListener(
                    'load',
                    () => {
                        this.preview = reader.result;
                    }, false
                );

                reader.readAsDataURL(this.file);
            }
        },
        deleteFile() {
            this.file = null;
            this.preview = null;
            this.progress = 0;
            this.error = null;
            this.fromStorage = false;

            this.clearFileInput();

            @this.deleteFile();
        },
        clearFileInput() {
            this.$refs.fileInput.value = null;
        },
        readableFileSizeString(fileSizeInBytes) {
            var i = -1;
            var byteUnits = [' kB', ' MB', ' GB', ' TB', 'PB', 'EB', 'ZB', 'YB'];
            do {
                fileSizeInBytes /= 1024;
                i++;
            } while (fileSizeInBytes > 1024);
          
            return Math.max(fileSizeInBytes, 0.1).toFixed(1) + byteUnits[i];
        },
        init() {
            window.addEventListener(
                'file-uploaded-has-errors-{{ $this->id }}', 
                event => {
                    this.error = event.detail;
                }
            );
            
            @if ($fileUrl) 
                let xhr = new XMLHttpRequest();
                this.fileMimeType = '{{ $fileMimeType }}';
                this.fileSize = {{ $fileSize }};

                xhr.onload = () => {
                    let reader = new FileReader();
                    reader.onloadend = () =>  {
                        this.preview = reader.result;
                    }
                    reader.readAsDataURL(xhr.response);
                };

                xhr.open('GET', '{{ addslashes($fileUrl) }}');
                xhr.responseType = 'blob';
                xhr.send();
            @endif
        },
        get uploadingStatus() {
            if (this.error) {
                return 'Error uploading your file';
            }

            if (this.isUploading) {
                return 'Uploading ' + this.progress + '%';
            }

            if (this.file !== null) {
                return 'Upload completed';
            }

            if (this.fromStorage) {
                return 'Uploaded';
            }

            return '';
        },
        get shouldShowDetails() {
            return this.isUploading || this.file !== null || this.fromStorage;
        }
    }"
>
    <label 
        for="{{ $fileInputId }}" 
        class="flex flex-col items-center justify-center w-full  rounded-lg cursor-pointer bg-gray-50 transition-all duration-500"
        :class="{ 
            'h-14': ! shouldShowDetails,
            'h-20': shouldShowDetails 
        }"
    >
        <div class="flex flex-col items-center justify-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-semibold">Click to upload</span> or drag and drop
            </p>
        </div>
        <input 
            id="{{ $fileInputId }}" 
            type="file" 
            class="hidden" 
            x-on:change="upload($event.target.files[0])"
            x-ref="fileInput"
        />
    </label>
    <div 
        class="absolute inset-0 rounded-lg p-2 "
        x-show="shouldShowDetails"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        x-cloak
    >
        <div class="h-full bg-gray-100 rounded-lg flex p-2 items-center">
            <img 
                class="rounded-lg h-full"
                :src="preview"
            >
            <div class="flex-1 px-4">
                <template x-if="file !== null || fromStorage">
                    <section>
                        <p class="text-gray-600 text-sm leading-tight" x-text="fileMimeType"></p>
                        <p class="text-gray-600 text-xs leading-tight" x-text="readableFileSizeString(fileSize)"></p>
                    </section>
                </template>
            </div>
            <div class="flex items-center space-x-2">
                <div 
                    class="text-right text-xs" 
                    :class="{ 
                        'text-red-400': error !== null,
                        'text-gray-600': error === null
                    }"
                >
                    <span 
                        class="block  leading-tight" 
                        x-text="uploadingStatus"
                    ></span>
                    <span 
                        class="block leading-tight" 
                        x-text="error"
                        x-show="error !== null"
                    ></span>
                </div>
                <div class="relative">
                    <button 
                        class="bg-gray-200 w-8 h-8 flex items-center justify-center rounded-full text-gray-600"
                        x-on:click.prevent="deleteFile()"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div 
                        class="absolute inset-0 rounded-full border-2 border-solid border-r-transparent border-indigo-500 animate-spin"
                        x-show="isUploading"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</div> 
