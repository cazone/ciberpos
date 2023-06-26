<template>
    <app-layout title="Arrendatario Nuevo">
        <template #header>
           <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted"></small>
                        <h1 class="h4 mt-1">Editar Usuario </h1>
                    </div>
                    <div class="col-auto">
                            <Link :href="route('users.index')" >
                        <a title="regrasar"  class="btn btn-white border lift">Regresar</a>
                        </Link>
                    </div>
                </div>
            </div>
        </template>

<div class="container">

                <div class="row g-3 justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><strong>Informaci&oacute;n del usuario</strong></h6>
                            </div>
                            <div class="card-body">
                                <form class="row g-3" @submit.prevent="submitForm">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                      <jet-label for="nombre" value="Ingresa completo " />
                                      <jet-input id="nombre" type="text" v-model="form.name"
                                                 :class="{ 'is-invalid': form.errors.name }" autocomplete="name" />
                                      <jet-input-error :message="form.errors.name" />
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                      <jet-label for="email" value="Ingresa email " />
                                      <jet-input id="email" type="text" v-model="form.email"
                                                 :class="{ 'is-invalid': form.errors.email }" autocomplete="email" />
                                      <jet-input-error :message="form.errors.email" />
                                    </div>





                                    <el-divider></el-divider>

                                    <el-checkbox-group v-model="form.roles">


    <el-checkbox v-for="rol in roles" :key="rol.id" :label="rol.name">{{
      rol.name
    }}</el-checkbox>

  </el-checkbox-group>

                                    <el-divider border-style="dashed" />
                                    <div class="col-12">
                                        <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                                           <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                             <span class="visually-hidden">Cargando...</span>
                                           </div>
                                            Guardar
                                         </jet-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- Personal Information Card End -->



                </div> <!-- .row end -->

            </div>


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
const user = computed(() => usePage().props.value.user)
const arrayRoles = [

];
onMounted(() => {
    user.value.roles.forEach((rol) => {
        arrayRoles.push(rol.name)
    })
    form.roles = arrayRoles
})
const form = useForm({
      name: user.value.name,
      email: user.value.email,
      telefono: user.value.telefono,
      notificaciones: user.value.notificaciones ? true : false,
      roles: [],


    })
    const roles = computed(() => usePage().props.value.roles)
    const submitForm = () => {
     form.put(route('users.update', user.value.id),{

     })
    }

</script>
<style scoped>

</style>
