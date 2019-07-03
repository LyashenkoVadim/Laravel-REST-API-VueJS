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
                <tr v-for="(library, index) in libraries" v-bind:key="library.id">
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
        <div class="mt-2">
            <div class="col-md-8">
                <nav>
                    <ul class="pagination">
                        <li v-bind:class="{ disabled: !pagination.first_link }" class="page-item"><a href="#" @click="viewLibraries(pagination.first_link)" class="page-link">&laquo;</a></li>
                        <li v-bind:class="{ disabled: !pagination.prev_link }" class="page-item"><a href="#" @click="viewLibraries(pagination.prev_link)" class="page-link">&lt;</a></li>
                        <li v-for="n in pagination.last_page" v-bind:key="n.current_page" v-bind:class="{ active: pagination.current_page == n }" class="page-item"><a href="#" @click="viewLibraries(pagination.path_page + '?page=' + n)" class="page-link">{{n}}</a></li>
                        <li v-bind:class="{ disabled: !pagination.next_link }" class="page-item"><a href="#" @click="viewLibraries(pagination.next_link)" class="page-link">&gt;</a></li>
                        <li v-bind:class="{ disabled: !pagination.last_link }" class="page-item"><a href="#" @click="viewLibraries(pagination.last_link)" class="page-link">&raquo;</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div>
            Page: {{ pagination.from_page }} - {{ pagination.to_page }}
            Total: {{ pagination.total_page }}
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                libraries: [],
                pagination: {},
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/libraries')
            .then(function (resp) {
                app.libraries = resp.data.data;
                app.pagination = {
                    current_page: resp.data.meta.current_page,
                    from_page: resp.data.meta.from,
                    last_page: resp.data.meta.last_page,
                    path_page: resp.data.meta.path,
                    per_page: resp.data.meta.per_page,
                    to_page: resp.data.meta.to,
                    total_page: resp.data.meta.total,
                    first_link: resp.data.links.first,
                    last_link: resp.data.links.last,
                    prev_link: resp.data.links.prev,
                    next_link: resp.data.links.next,
                }
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Could not load libraries");
            });
        },
        methods: {
            viewLibraries(pagi){
                pagi = pagi || '/api/libraries';
                fetch(pagi)
                .then(resp => resp.json())
                .then(resp =>{
                    this.libraries = resp.data;
                    this.pagination ={
                        current_page: resp.meta.current_page,
                        from_page: resp.meta.from,
                        last_page: resp.meta.last_page,
                        path_page: resp.meta.path,
                        per_page: resp.meta.per_page,
                        to_page: resp.meta.to,
                        total_page: resp.meta.total,
                        first_link: resp.links.first,
                        last_link: resp.links.last,
                        prev_link: resp.links.prev,
                        next_link: resp.links.next,
                    };
                })
                .catch(err => console.log(err));
            },
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
