<template>
    <div class="panel" v-if="show">
        <div class="panel-heading">
            <span class="panel-title">{{title}} Invoice</span>
        </div>
        <div class="panel-body">
           <div class="row">
               <div class="col-12">
                   <div class="form-group">
                       <label>Customer</label>
                       <typeahead :url="customerURL" :initialize="form.customer"
                                  @input="onCustomer" />
                   </div>
               </div>
               <div class="col-6">
                   <div class="form-group">
                       <label>
                           Number
                           <small>Auto Generated</small>
                       </label>
                       <span class="form-control">{{ form.number }}</span>
                   </div>
               </div>
               <div class="col-6">
                   <div class="form-group">
                       <label>Reference</label>
                       <input type="text" class="form-control" v-model="form.reference">
                       <small class="error-control" v-if="errors.reference">
                           {{errors.reference[0]}}
                       </small>
                   </div>
               </div>

           </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" v-model="form.date">
                        <small class="error-control" v-if="errors.date">
                            {{errors.date[0]}}
                        </small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" class="form-control" v-model="form.due_date">
                        <small class="error-control" v-if="errors.due_date">
                            {{errors.due_date[0]}}
                        </small>
                    </div>
                </div>
            </div>
            <hr>
            <table class="form-table">
                <thead>
                  <tr>
                    <th>Item Description</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                  </tr>
                </thead>
            </table>
        </div>

    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue'
    import {get, byMethod} from '../../lib/api'
    import {Typeahead} from '../../components/typeahead'

    function initialize(to) {
        let urls = {
            'create': `/api/invoices/create`,
            'edit':`/api/invoices/${to.params.id}/edit`
        }

        return urls[to.meta.mode]
    }

    export default {
        components: {
            Typeahead
        },
        data(){
            return {
                form: {},
                errors: {},
                isProcessing: false,
                show: false,
                resource: '/invoices',
                store: '/api/invoices',
                method: 'POST',
                title: 'Create',
                productURL: '/api/products',
                customerURL: '/api/customers'
            }
        },
        beforeRouteEnter(to,from,next) {
            get(initialize(to))
                .then((res) => {
                   next(vm => vm.setData(res))
                })
        },
        beforeRouteUpdate(to,from,next) {
            this.show = false
            get(initialize(to))
                .then((res) => {
                    this.setData(res)
                    next()
                })
        },
        methods: {
            setData(res) {
                Vue.set(this.$data,'form',res.data.form)
                if (this.$route.meta.mode === 'edit'){
                    this.store = `/api/invoices/${this.$route.params.id}`
                    this.method = 'PUT'
                    this.title = 'Edit'
                }
                this.show = true
            },
            onCustomer(){

            },
            onProduct(){

            },
            removeItem(){

            }
        }
    }
</script>