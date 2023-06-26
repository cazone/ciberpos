<template>
    <app-layout title="Usuarios">
        <template #header>
           <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted">Listado de usuarios</small>
                        <h1 class="h4 mt-1">Usuarios del sistema </h1>
                    </div>
                    <div class="col-auto">
                            <Link :href="route('users.create')" >
                        <a title="regrasar"  class="btn btn-white border lift">Nuevo Usuario</a>
                        </Link>
                    </div>
                </div>
            </div>
        </template>


      <el-card class="box-card">
    <template #header>
         <!-- <div class="col-12">
                        <div class="card">
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><strong>Buscar  Arrendatario</strong></h6>
                            </div>
                            <div class="card-body">
                                <form class="row g-3" @submit="buscar">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                      <jet-label for="nombre" value="Ingresa nombre " />
                                      <jet-input id="nombre" type="text" v-model="form.nombre" @keypress.enter="buscar"
                                                 :class="{ 'is-invalid': form.errors.nombre }" autocomplete="nombre" />

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                      <jet-label for="apellidos" value="Ingresa apellidos" />
                                      <jet-input id="apellidos" type="text" v-model="form.apellidos" @keypress.enter="buscar"
                                                 :class="{ 'is-invalid': form.errors.apellidos }" autocomplete="apellidos" />
                                      <jet-input-error :message="form.errors.apellidos" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                      <jet-label for="email" value="Ingresa email " />
                                      <jet-input id="email" type="text" v-model="form.email"
                                                 :class="{ 'is-invalid': form.errors.email }" autocomplete="email" />
                                      <jet-input-error :message="form.errors.email" />
                                    </div>

                               <div class="col-12">
                                          <Link :href="route('users.index')" >
                        <a title="regrasar"  class="btn btn-white border lift">Limpiar busqueda</a>
                        </Link>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
    </template>
        <el-table :data="users.data" stripe style="width: 100%">
        <el-table-column  fixed  prop="id" label="ID"  width="50"/>
            <el-table-column prop="name" label="Nombre" />

            <el-table-column prop="email" label="Correo" />

            <el-table-column prop="roles" label="Roles">
              <template #default="scope">
                <div v-for="rol in scope.row.roles" :key="scope.row">

                <el-tag> {{rol.name}}</el-tag>

                </div>
            </template>
            </el-table-column>
            <el-table-column fixed="right" label="" width="180">



                <template #default="scope">

    <Link :href="route('users.edit', scope.row.id)"  >
      <el-tooltip
                         class="box-item"
                         effect="dark"
                         content="Editar arrendatario"
                         placement="top"
                    >
                         <el-button type="primary"   circle >
                            <i class="fa fa-edit" data-bs-toggle="tooltip" title="" data-bs-original-title="fa fa-edit" aria-label="fa fa-edit"></i>
                         </el-button>
                     </el-tooltip>
                    </Link>
                    <el-divider direction="vertical"  border-style=""/>
                    <el-tooltip
                         class="box-item"
                         effect="dark"
                         content="Eliminar arrendatario"
                         placement="top"
                    >

                         <el-button type="danger"  @click="eliminarShow(scope.row.id)" circle >
                            <i class="fa fa-trash" data-bs-toggle="tooltip" title="" data-bs-original-title="fa fa-trash" aria-label="fa fa-trash"></i>
                         </el-button>
                     </el-tooltip>
                </template>

            </el-table-column>
        </el-table>

        <el-divider></el-divider>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-for="link in users.links" :key="link.id"
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
    width="30%">
       <form class="row g-4 maskking-form" @submit.prevent="submitForm" >
          <jet-label for="nombre" value="Ingresa nombre del local" />
          <jet-input id="nombre" type="text" v-model="form.nombre"
                     :class="{ 'is-invalid': form.errors.nombre }" autocomplete="nombre" />
          <jet-input-error :message="form.errors.nombre" />
                    <jet-label for="grupos" value="Seleccione el grupo" />
                <el-select v-model="form.grupo_id" class="m-2" placeholder="Seleccionar" size="large" id="grupos" name="grupos">
                  <el-option
                    v-for="item in grupos"
                    :key="item.id"
                    :label="item.nombre"
                    :value="item.id"
                  />
                </el-select>
          <jet-input-error :message="form.errors.grupo_id" />
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
import {  ref , computed, onUpdated, onMounted} from "vue";
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
const form = useForm({
      nombre: null,
      apellidos: null,
      email: null,

    })
onMounted(() => {
  if(flash.value){
   ElMessage({
    message: flash.value,
    type: 'success',
  })
  }
}),

onUpdated(() => {
 ElMessage({
    message: flash.value,
    type: 'success',
  })

})
const users = computed(() => usePage().props.value.users)
const flash = computed(() => usePage().props.value.flash.success)

        const buscar = () => {
            form.get(route("users.index"), form.value)
        }

let elimar_id = null
const dialogEliminar=ref(false)

const eliminarShow = (row) => {
      dialogEliminar.value = true
      elimar_id = row
}
const eliminar = () =>{
      form.delete(route("users.destroy", elimar_id))
      dialogEliminar.value = false
}


</script>
<style scoped>

</style>
