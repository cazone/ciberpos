<template>
  <app-layout title="Lista">
    <template #header>

    </template>
    <div class="page-header">
						<div class="page-title">
							<h4>Crear lista de paquetes </h4>
							<h6>Paquetes</h6>
						</div>
						<div class="page-btn">
							<Link :href="route('package.index')"  class="btn btn-added">
								Regresar
							</Link>
						</div>
					</div>
                    <div class="card">
						<div class="card-body">
              <form  @submit.prevent="submitForm">
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Nombre del paquete</label>
                    <jet-input id="name" type="text" v-model="form.name"
                     :class="{ 'is-invalid': form.errors.name }" autocomplete="name" />
                    <jet-input-error :message="form.errors.name" />
									</div>
								</div>
                                <div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Descripc&oacute;n</label>
                    <jet-input id="discount" type="text" v-model="form.description"
                     :class="{ 'is-invalid': form.errors.description }" autocomplete="description" />
                    <jet-input-error :message="form.errors.description" />
									</div>
								</div>


								<div class="col-lg-12">
                  <jet-button :class="{ 'text-white-50': form.processing }" class="btn btn-submit me-2" :disabled="form.processing">
               <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                 <span class="visually-hidden">Cargando...</span>
               </div>
                Guardar
             </jet-button>

								</div>
							</div>
            </form>
						</div>
					</div>

  </app-layout>
</template>

<script setup>

import {  ref, onUpdated , computed, onMounted} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import { ElMessage } from 'element-plus'

const form = useForm({
          name: "",
          description: "",


    })
let elimar_id = null
const dialogEliminar=ref(false)

const eliminarShow = (row) => {
      dialogEliminar.value = true
      elimar_id = row
}
const eliminar = () =>{
      form.delete(route("category.destroy", elimar_id))
      dialogEliminar.value = false
}

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
const categories = computed(() => usePage().props.value.categories)
const flash = computed(() => usePage().props.value.flash.success)
</script>
