<template>
    <app-layout title="Categorias">
        <template #header>
           <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted">Listado de roles</small>
                        <h1 class="h4 mt-1">Roles</h1>
                    </div>
                    <div class="col-auto">
                        <a title="Nueva categoria"  @click="showDialogNew" class="btn btn-white border lift">Nuevo role</a>
                    </div>
                </div>
            </div>
        </template>


      <el-card class="box-card">
    <template #header>

    </template>
        <el-table :data="roles.data" stripe style="width: 100%">
        <el-table-column  fixed  prop="id" label="ID"  width="50"/>
            <el-table-column prop="name" label="Nombre del rol" />
            <el-table-column fixed="right" label="" width="180">
                <template #default="scope">

                    <el-tooltip
                         class="box-item"
                         effect="dark"
                         content="Eliminar"
                         placement="top"
                    >
                         <el-button type="danger" icon="fa fa-trash-o"  @click="eliminarShow(scope.row.id)" circle />
                     </el-tooltip>

                    <el-tooltip
                         class="box-item"
                         effect="dark"
                         content="Editar"
                         placement="top"
                    >
                         <el-button type="info" icon="fa fa-edit"  @click="showDialogEditar(scope.row)" circle />
                     </el-tooltip>


                </template>
            </el-table-column>
        </el-table>

        <el-divider></el-divider>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-for="link in roles.links" :key="link.id"
                    class="page-item"
                    :class="{ active: link.active }"
                >
                    <Link
                        class="page-link"
                        :href="link.url"
                        v-html="link.label"
                    ></Link>
                </li>

            </ul>
        </nav>
  </el-card>

  <el-dialog v-model="dialogEliminar" title="Eliminar" width="30%">
    <span
      >¿Estas seguro de eliminar?</span
    >
    <template #footer>
      <span class="dialog-footer">
        <el-button @click="dialogEliminar = false">Cancelar</el-button>
        <el-button type="primary" @click="eliminar"
          >Confirmar</el-button
        >
      </span>
    </template>
  </el-dialog>

  <el-dialog
    v-model="dialogVisible"
    :title="title"
    width="40%">
       <form class="row g-4 maskking-form" @submit.prevent="submitForm" >
          <jet-label for="nombre" value="Ingresa nombre del grupo" />
          <jet-input id="nombre" type="text" v-model="form.name"
                     :class="{ 'is-invalid': form.errors.name }" autocomplete="name" />
          <jet-input-error :message="form.errors.name" />


         <div class="col-12">
            <jet-secondary-button type="button" class="me-md-2"  @click="dialogVisible = false">
              Cancelar
            </jet-secondary-button>
            <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
               <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                 <span class="visually-hidden">Cargando...</span>
               </div>
                Guardar
             </jet-button>
          </div>

        </form>
  </el-dialog>
    </app-layout>
</template>

<script setup>
import {  ref , computed, onUpdated} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage } from '@inertiajs/inertia-vue3'
import { Link } from "@inertiajs/inertia-vue3";
import { ElMessage } from 'element-plus'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import JetButton from '@/Jetstream/Button.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

onUpdated(() => {
 ElMessage({
    message: flash.value,
    type: 'success',
  })

})
const roles = computed(() => usePage().props.value.roles)
const flash = computed(() => usePage().props.value.flash.success)

const dialogVisible=ref(false)
const title=ref("")
const form = useForm({
      name: null,


    })
let routeModule = null
let type = null
let elimar_id = null
const dialogEliminar=ref(false)

const eliminarShow = (row) => {
      dialogEliminar.value = true
      elimar_id = row
}
const eliminar = () =>{
      form.delete(route("roles.destroy", elimar_id))
      dialogEliminar.value = false
}

const showDialogNew = () => {
  form.reset()
  type = "post"
  routeModule = route('roles.store')
  title.value = "Nueva rol"
  dialogVisible.value = true
}
const showDialogEditar = (row) => {
  form.name = row.name


  type = "put"
  routeModule = route('roles.update', row.id)
  title.value = "Editar rol"
  dialogVisible.value = true
}
const submitForm = () => {
      form.submit (type,routeModule, {
        preserveScroll: true,
         onSuccess: () => {
          dialogVisible.value = false
          form.reset()
      } });
}
</script>
<style scoped>

</style>
