{{-- Livewire Chat Component --}}

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __($user->name) }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div id="chat-container"
            class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-15 overflow-y-auto h-[calc(100vh-12rem)] scroll-smooth">

            <div class="w-full px-5 py-8 grow" id="message-list">
                @foreach ($messages as $message)
                    @if ($message->sender->id != auth()->user()->id)
                        {{-- Receiver Message --}}
                        <div class="grid pb-3">
                            <div class="flex gap-2.5">
                                <img src="https://pagedone.io/asset/uploads/1710412177.png" alt="Shanay image"
                                    class="w-10 h-11">
                                <div class="grid">
                                    <h5 class="text-gray-900 text-sm font-semibold leading-snug pb-1">
                                        {{ $message->sender->name }} </h5>
                                    <div class="w-max grid">

                                        @if ($message->message)
                                            <div
                                                class="px-3.5 py-2 bg-gray-100 rounded-3xl rounded-tl-none justify-start items-center gap-3 inline-flex">
                                                <h5 class="text-gray-900 text-sm font-normal leading-snug">
                                                    {{ $message->message }}</h5>
                                            </div>
                                        @else
                                            @php
                                                $imgType = str_starts_with($message->file_type, 'image/')
                                                    ? true
                                                    : false;
                                            @endphp

                                            <div>
                                                <span>
                                                    @if ($imgType)
                                                        <a href="{{ asset('chat_files/' . $message->file_path) }}">
                                                            <img src="{{ asset('chat_files/' . $message->file_path) }}"
                                                                alt="file"
                                                                class="w-12 h-12 rounded-lg object-cover border border-gray-300 shadow-md" />
                                                        </a>
                                                    @else
                                                        <a class="flex items-center justify-between bg-gray-200 px-3 py-2 rounded"
                                                            download
                                                            href="{{ asset('chat_files/' . $message->file_path) }}">
                                                            <svg class="cursor-pointer"
                                                                xmlns="http://www.w3.org/2000/svg" width="22"
                                                                height="22" viewBox="0 0 22 22" fill="none">
                                                                <g id="Attach 01">
                                                                    <g id="Vector">
                                                                        <path
                                                                            d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                                                            stroke="black" stroke-width="1.6"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                                                            stroke="black" stroke-opacity="0.2"
                                                                            stroke-width="1.6" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                                                            stroke="black" stroke-opacity="0.2"
                                                                            stroke-width="1.6" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            <span
                                                                class="w-full max-w-64">{{ $message->file_name_original }}</span>
                                                        </a>
                                                    @endif
                                                </span>
                                            </div>
                                        @endif

                                        <div class="justify-end items-center inline-flex mb-2.5">
                                            <h6 class="text-gray-500 text-xs font-normal leading-4 py-1">
                                                <strong>{{ $message->formatted_date }}</strong>
                                                {{ $message->created_at->format('h:i A') }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Sender Message --}}
                        <div class="flex gap-2.5 justify-end pb-3">
                            <div class="">
                                <div class="grid mb-2">
                                    <h5 class="text-right text-gray-900 text-sm font-semibold leading-snug pb-1">You
                                    </h5>

                                    @if ($message->message)
                                        <div class="px-3 py-2 bg-indigo-600 rounded-3xl rounded-tr-none">
                                            <h2 class="text-white text-sm font-normal leading-snug">
                                                {{ $message->message }}
                                            </h2>
                                        </div>
                                    @else
                                        <div>
                                            @php
                                                $imgType = str_starts_with($message->file_type, 'image/')
                                                    ? true
                                                    : false;
                                            @endphp
                                            <span>
                                                @if ($imgType)
                                                    <a href="{{ asset('chat_files/' . $message->file_path) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('chat_files/' . $message->file_path) }}"
                                                            alt="file"
                                                            class="w-12 h-12 rounded-lg object-cover border border-gray-300 shadow-md" />
                                                    </a>
                                                @else
                                                    <a class="flex items-center justify-between bg-indigo-600 px-3 py-2 rounded text-white"
                                                        download
                                                        href="{{ asset('chat_files/' . $message->file_path) }}">
                                                        <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                                                            width="22" height="22" viewBox="0 0 22 22"
                                                            fill="none">
                                                            <g id="Attach 01">
                                                                <g id="Vector">
                                                                    <path
                                                                        d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                                                        stroke="white" stroke-width="1.6"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                                                        stroke="white" stroke-opacity="0.2"
                                                                        stroke-width="1.6" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                                                        stroke="white" stroke-opacity="0.2"
                                                                        stroke-width="1.6" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <span
                                                            class="w-full max-w-64">{{ $message->file_name_original }}</span>
                                                    </a>
                                                @endif
                                            </span>
                                        </div>
                                    @endif
                                    <div class="justify-start items-center inline-flex">
                                        <h3 class="text-gray-500 text-xs font-normal leading-4 py-1">
                                            <strong>{{ $message->formatted_date }}</strong>
                                            {{ $message->created_at->format('h:i A') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <img src="https://pagedone.io/asset/uploads/1704091591.png" alt="Hailey image"
                                class="w-10 h-11">
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Bottom Message Search Box --}}
            <form wire:submit="sendMessage" class="w-full px-3 py-2 border-t border-gray-200 bg-white sticky bottom-0">
                <div
                    class="w-full pl-3 pr-1 py-1 rounded-3xl border border-gray-200 items-center gap-2 flex justify-between">
                    <div class="flex w-full items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                            fill="none">
                            <g id="User Circle">
                                <path id="icon"
                                    d="M6.05 17.6C6.05 15.3218 8.26619 13.475 11 13.475C13.7338 13.475 15.95 15.3218 15.95 17.6M13.475 8.525C13.475 9.89191 12.3669 11 11 11C9.6331 11 8.525 9.89191 8.525 8.525C8.525 7.1581 9.6331 6.05 11 6.05C12.3669 6.05 13.475 7.1581 13.475 8.525ZM19.25 11C19.25 15.5563 15.5563 19.25 11 19.25C6.44365 19.25 2.75 15.5563 2.75 11C2.75 6.44365 6.44365 2.75 11 2.75C15.5563 2.75 19.25 6.44365 19.25 11Z"
                                    stroke="#4F46E5" stroke-width="1.6" />
                            </g>
                        </svg>

                        {{-- Message Input --}}
                        <input autocomplete="off" id="message-input" wire:model="message" wire:keydown="userTyping"
                            class="grow shrink basis-0 text-black text-xs font-medium rounded leading-4 focus:outline-none"
                            placeholder="Type here...">
                    </div>

                    <div class="flex items-center gap-2">

                        {{-- Attachment --}}
                        <label title="Attachment" for="fileUpload" class="cursor-pointer flex items-center">

                            <input type="file" id="fileUpload" wire:model="file" wire:change="sendFileMessage"
                                class="hidden">

                            <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="22"
                                height="22" viewBox="0 0 22 22" fill="none">
                                <g id="Attach 01">
                                    <g id="Vector">
                                        <path
                                            d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                            stroke="#9CA3AF" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                            stroke="black" stroke-opacity="0.2" stroke-width="1.6"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675"
                                            stroke="black" stroke-opacity="0.2" stroke-width="1.6"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </g>
                            </svg>
                        </label>

                        {{-- Submit button --}}
                        <button type="submit" class="items-center flex px-3 py-2 bg-indigo-600 rounded-full shadow ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 16 16" fill="none">
                                <g id="Send 01">
                                    <path id="icon"
                                        d="M9.04071 6.959L6.54227 9.45744M6.89902 10.0724L7.03391 10.3054C8.31034 12.5102 8.94855 13.6125 9.80584 13.5252C10.6631 13.4379 11.0659 12.2295 11.8715 9.81261L13.0272 6.34566C13.7631 4.13794 14.1311 3.03408 13.5484 2.45139C12.9657 1.8687 11.8618 2.23666 9.65409 2.97257L6.18714 4.12822C3.77029 4.93383 2.56187 5.33664 2.47454 6.19392C2.38721 7.0512 3.48957 7.68941 5.69431 8.96584L5.92731 9.10074C6.23326 9.27786 6.38623 9.36643 6.50978 9.48998C6.63333 9.61352 6.72189 9.7665 6.89902 10.0724Z"
                                        stroke="white" stroke-width="1.6" stroke-linecap="round" />
                                </g>
                            </svg>
                            <h3 class="text-white text-xs font-semibold leading-4 px-2">Send</h3>
                        </button>
                    </div>

                    {{-- File Preview --}}
                    @if ($file)
                        <div class="mt-2 p-2 bg-gray-100 rounded-lg flex items-center justify-between">
                            @php
                                $imgType = str_starts_with($file->getMimeType(), 'image/') ? true : false;
                            @endphp
                            <span>
                                @if ($imgType)
                                    <img src="{{ $file->temporaryUrl() }}" alt="file"
                                        class="w-12 h-12 rounded-lg object-cover border border-gray-300 shadow-md" />
                                @else
                                    <span class="w-full max-w-64">{{ $file->getClientOriginalName() }}</span>
                                @endif
                            </span>
                            <button type="button" wire:click="$set('file', null)" class="text-red-500 ms-2"><span
                                    class="text-2xl">x</span></button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@script
    <script type="module">
        let typingTimeout;
        const chatContainer = document.getElementById('chat-container');

        window.Echo.private(`chat-channel.{{ $senderId }}`)
            .listen('UserTyping', (event) => {
                const messageInputField = document.getElementById('message-input');
                if (messageInputField) {
                    messageInputField.placeholder = 'Typing...';
                }

                clearTimeout(typingTimeout);
                typingTimeout = setTimeout(() => {
                    if (messageInputField) {
                        messageInputField.placeholder = 'Type here...';
                    }
                }, 2000);
            })

            .listen('MessageSentEvent', (event) => {
                const isInputFocused = document.activeElement === messageInputField;
                const isScrolledToBottom = chatContainer.scrollTop + chatContainer.clientHeight >= chatContainer
                    .scrollHeight - 10;

                if (!isInputFocused || !isScrolledToBottom) {
                    const audio = new Audio('{{ asset('sounds/notification.mp3') }}');
                    audio.play();
                }
            });

        // Listen for Livewire events
        Livewire.on('messages-updated', () => {
            setTimeout(() => {
                scrollToBottom();
            }, 50);
        });

        // Scroll on initial load
        window.onload = () => {
            scrollToBottom();
        };

        function scrollToBottom() {
            if (chatContainer) {
                chatContainer.scrollTo(0, chatContainer.scrollHeight);
            }
        }
    </script>
@endscript
