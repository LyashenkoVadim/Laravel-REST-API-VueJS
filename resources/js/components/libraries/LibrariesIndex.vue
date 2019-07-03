<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createLibrary'}" class="btn btn-success">Create new library</router-link>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Libraries list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                <tbody>
                <tr v-for="(library, index) in libraries.data" v-bind:key="library.id">
                    <td>{{ library.library_name }}</td>
                    <td>{{ library.address }}</td>
                    <td>
                        <router-link :to="{name: 'editLibrary', params: {id: library.id}}" class="btn btn-xs btn-default">
                            Edit
                        </router-link>
                        <a href="#"
                            class="btn btn-xs btn-danger"
                            v-on:click="deleteEntry(library.id, index)">
                            Delete
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                libraries: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/libraries')
            .then(function (resp) {
                app.libraries = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Could not load libraries");
            });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/libraries/' + id)
                    .then(function (resp) {
                        app.libraries.splice(index, 1);
                    })
                    .catch(function (resp) {
                        alert("Could not delete library");
                    });
                }
            }
        }
    }
</script>
