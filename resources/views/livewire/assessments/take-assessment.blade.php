<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-zinc-800 shadow-sm sm:rounded-3xl p-8 border border-zinc-200 dark:border-zinc-700">
        <div class="mb-8 border-b border-zinc-200 dark:border-zinc-700 pb-5 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $assessment->title }}</h1>
                <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $assessment->description }}</p>
            </div>
            @if($assessment->duration_minutes)
                <div class="text-right shrink-0">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-800 dark:bg-red-900/30 dark:text-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Temps limite : {{ $assessment->duration_minutes }} min
                    </span>
                </div>
            @endif
        </div>

        <form wire:submit.prevent="submit" class="space-y-10">
            @foreach($assessment->questions as $index => $question)
                <div class="bg-zinc-50 dark:bg-zinc-900/50 rounded-2xl p-6 border border-black/5 dark:border-white/5">
                    <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-4">
                        <span class="text-emerald-500 font-bold mr-2">{{ $index + 1 }}.</span>
                        {{ $question->question_text }}
                        <span class="text-sm font-normal text-zinc-400 ml-2">({{ $question->points }} pts)</span>
                    </h3>

                    @if(in_array($question->type, ['multiple_choice', 'qcm'], true))
                        <div class="space-y-3 mt-4">
                            @foreach($question->options as $option)
                                <label class="flex items-center p-3 rounded-xl border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer transition">
                                    <input type="radio" wire:model="answers.{{ $question->id }}" value="{{ $option->id }}" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-zinc-300 dark:border-zinc-600 dark:bg-zinc-800">
                                    <span class="ml-3 text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $option->option_text }}</span>
                                </label>
                            @endforeach
                        </div>
                    @elseif($question->type === 'text')
                        <textarea wire:model="answers.{{ $question->id }}" rows="4" class="mt-4 block w-full rounded-xl border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white sm:text-sm" placeholder="Votre réponse..."></textarea>
                    @elseif(in_array($question->type, ['code_editor', 'code'], true))
                        <div class="mt-4 rounded-xl overflow-hidden border border-zinc-300 dark:border-zinc-700" x-data="codeEditor({{ $question->id }}, @js($this->answers[$question->id] ?? ''))" x-init="init()">
                            <div wire:ignore x-show="editorLoaded" class="min-h-[300px] w-full">
                                <div id="editor_container_{{ $question->id }}" class="min-h-[300px] w-full"></div>
                            </div>

                            <div x-show="!editorLoaded" class="min-h-[300px] w-full bg-zinc-50 dark:bg-zinc-900 p-4">
                                <label class="sr-only" for="code_fallback_{{ $question->id }}">Éditeur de code de secours</label>
                                <textarea id="code_fallback_{{ $question->id }}" wire:model="answers.{{ $question->id }}" rows="10" class="min-h-[300px] w-full resize-none rounded-xl border border-zinc-200 bg-white p-4 text-sm text-zinc-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white" placeholder="Votre code..."></textarea>
                                <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">L'éditeur de code se charge. Si rien n'apparaît, utilisez cette zone de texte.</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

           <div class="pt-6 border-t border-zinc-200 dark:border-zinc-700 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
               <p class="text-sm text-zinc-500 dark:text-zinc-400">Les réponses de code sont envoyées pour correction automatique en file d'attente si Judge0 est activé.</p>
               <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-8 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition">
                   Soumettre mon évaluation
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                   </svg>
               </button>
           </div>
       </form>
   </div>

</div>
