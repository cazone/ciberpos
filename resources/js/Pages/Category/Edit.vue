<template>
  <app-layout title="Nueva Categoria">
    <template #header>
 
    </template>
    
    <div class="page-header">
						<div class="page-title">
							<h4>Producto editar categoría</h4>
							<h6>Editar categoría de producto</h6>
						</div>
		</div>
    <div class="card">
						<div class="card-body">
              <form  @submit.prevent="submitForm">
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Nombre de categoria</label>
                    <jet-input id="name" type="text" v-model="form.name"
                     :class="{ 'is-invalid': form.errors.name }" autocomplete="name" />
                    <jet-input-error :message="form.errors.name" />
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

import {  ref , computed} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/inertia-vue3'

const category = computed(() => usePage().props.value.category)

const form = useForm({
      name: category.value.name,

    })

const submitForm = () => {
     form.put(route('category.update', category.value.id),{

     })
}
</script>
