<template lang="">
    <div class="row">
        <div class="col-md-12">
            <div class="form-check-inline">
                <input type="radio" 
                       class="form-check-input" 
                       id="inlineradio1" 
                       name="permission_type" 
                       v-model="permissionData.permission_type" 
                       value="basic">
                <label for="inlineradio1" class="form-check-label">Basic</label>
            </div>
            <div class="form-check-inline">
                <input type="radio" 
                       class="form-check-input" 
                       id="inlineradio2" 
                       name="permission_type" 
                       v-model="permissionData.permission_type" 
                       value="crud">
                <label for="inlineradio2" class="form-check-label">CRUD</label>
            </div>
        </div>
    </div>

    <div class="row" v-if="permissionData.permission_type == 'basic'">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="display_name">Display Name</label>
                <input type="text" class="form-control" name="display_name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description">
            </div>
        </div>
    </div>

    <div class="row" v-if="permissionData.permission_type == 'crud'">
        <div class="col-md-4">
            <div class="form-group">
                <label for="resource">Resource</label>
                <input type="text" 
                       class="form-control" 
                       name="resource" 
                       v-model="permissionData.resource">
            </div>
        </div>
        <div class="col-md-8 mt-4 pt-3">
            <div class="form-check-inline" v-for="(item,index) in permissionData.crud" :key="index" >
                <input type="checkbox" 
                       class="form-check-input" 
                       :id="'item'+index " 
                       name="crudSelected[]"
                       v-model="permissionData.selectedCrud" 
                       :value="item"
                       checked
                         >
                <label :for="'item'+index " class="form-check-label"> {{ capitalizeFirstLetter(item) }} </label>
            </div>
        </div>
    </div>
    <div class="row"
        v-if="permissionData.permission_type == 'crud' " >
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in permissionData.selectedCrud" :key="index">
                    <td v-text="crudName(item)" > </td>
                    <td v-text="crudDisplayName(item)"></td>
                    <td v-text="crudDisplayName(item)"></td>
                    
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data(){
        return {
            permissionData: {
                    resource: '',
                    permission_type: 'basic',
                    crud: ['create', 'read', 'update', 'delete'],
                    selectedCrud:['create', 'read', 'update', 'delete']
                }
        }
    },
     methods: {
        capitalizeFirstLetter(item){
            return item.charAt(0).toUpperCase() + item.substring(1);
        },
            crudName(item) {
                return this.permissionData.resource.toLowerCase() + '-' + item.toLowerCase();
            },
            crudDisplayName(item) {
                return this.capitalizeFirstLetter(this.permissionData.resource) + ' ' + this.capitalizeFirstLetter(item);
            },
        }
}
</script>
<style lang="">
    
</style>