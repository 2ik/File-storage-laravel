<template>
    <div class="container">
        <form v-on:submit="addTask">
            <label for="basic-url">Your URL</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="add-url">URL:</span>
                </div>
                <input type="text" class="form-control" :class="log" v-model="url" placeholder="URL">
            </div>
            <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
        <ul class="list-group">
        <li v-for="resource in resources.slice().reverse()" :key="resource.id" class="list-group-item list-group-item-action">
            <span v-if="resource.status == 1"><span class="badge badge-primary badge-pill">pending</span></span>
            <span v-if="resource.status == 2"><span class="badge badge-secondary badge-pill">downloading</span></span>
            <span v-if="resource.status == 3"><span class="badge badge-success badge-pill">complete</span></span>
            <span v-if="resource.status == 4"><span class="badge badge-danger badge-pill">error</span></span>
            {{resource.url}}
            <a href="javascript:void(0);" v-if="resource.download_link"><span v-on:click="getFile" :data-id="resource.download_link" class="badge badge-success">Download</span></a>
        </li>
        </ul>
    </div>
</template>

<script>

import axios from "axios";

    export default {

        data: () => ({
            status: '',
            url: '',
            log: '',
            resources: [],
            errors: []
        }),

        mounted() {
            axios.get('/api/resources')
            .then(response => {
                this.resources = response.data
            })
            .catch(e => {
                console.log(e)
                this.errors.push(e)
            })
        },
        
        methods: {
            addTask:function(e) {

                e.preventDefault()

                this.log = ''

                var url = this.url;

                if(this.url == ""){
                    this.log = "border-danger"
                }else{

                    axios.post('/api/resources', {
                        url: url
                    })
                    .then(response => {
                        // console.log(JSON.parse(JSON.stringify(response.data)))
                        this.resources.push(response.data)
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
                }
            }, 
            getFile: function(e){
                e.preventDefault();

                console.log(e);
                var id = e.target.dataset.id
                var parent = e.target.parentElement

                axios.get('/api/file/' + id).then(response => {
                    console.log(JSON.parse(JSON.stringify(response.data)))
                    console.log(parent)
                    parent.setAttribute('href', response.data.download_link)
                    parent.setAttribute('download',"")
                    
                    parent.click()
                })
                .catch(e => {
                    this.errors.push(e)
                })

            }
        }
    }
</script>
