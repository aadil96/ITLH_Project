<template>
    <div v-show="isVisible" class="container text-center ml-4 mr-4 m-auto rounded">
        <div class="p-2 bg-teal-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
            <span class="flex rounded-full bg-teal-500 uppercase px-2 py-1 text-xs font-bold mr-3" v-html="title"></span>
            <span class="font-semibold mr-2 text-left flex-auto" v-html="body"></span>
            <svg @click="isVisible = false" class="fill-current opacity-75 h-4 w-4" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'body'],
        data(){
            return {
                isVisible: true,
            }
        },
    }
</script>
