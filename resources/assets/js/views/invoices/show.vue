<template>
    <div class="panel" v-if="show">
        <div class="panel-heading">
           <span class="panel-title">{{model.number}}</span>
            <div>
                <router-link to="/invoices" class="btn">Back</router-link>
                <router-link to="`/invoices/${model.id}/edit`" class="btn">Edit</router-link>
                <button class="btn btn-error">Delete</button>
            </div>
        </div>
        <div class="panel-body">

        </div>
    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue'
    import {get, byMethods} from '../../lib/api'

    export default {
        data(){
            return {
                show:false,
                model: {
                    items: [],
                    customer: {}
                }
            }
        },
        beforeRouteUpdate(to,from,next) {
            this.show = false
            get('/api/invoices/${to.params.id}')
                .then((res) => {
                   this.setData(res)
                    next()
                })
        },
        mounted() {
            get('/api/invoices/' + this.$route.params.id).then(response=>{
               this.setData(response)
                console.log('success')
            })
        },
        methods: {
            setData(res){
                Vue.set(this.$data,'model',res.data.model)
                this.show = true
            }
        }

    }
</script>
