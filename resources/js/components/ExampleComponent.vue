<template id="my">
    <div id="app">
        {{ libraries }}
    </div>
</template>


<script>
    export default {
        data(){
            return {
                libraries: null
            };
        },
        mounted() {
            axios
            .get('http://laravel-rest-api-vuejs/api/libraries')
            .then(response => (this.libraries = response));
        }
    }
</script>
