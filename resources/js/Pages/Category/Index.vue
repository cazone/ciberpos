<template>
  <app-layout title="Lista">
    <template #header>

    </template>
    <div class="page-header">
						<div class="page-title">
							<h4>Lista de categorías de productos</h4>
							<h6>Ver/Buscar categoría de producto</h6>
						</div>
						<div class="page-btn">
							<Link :href="route('category.create')"  class="btn btn-added">
								<img src="assets/img/icons/plus.svg"  class="me-1" alt="img">Nueva Categoria
							</Link>
						</div>
					</div>
          <div class="card">
						<div class="card-body">
							<div class="table-top">


							</div>
              <el-table :data="categories.data" stripe style="width: 100%">
        <el-table-column  fixed  prop="id" label="ID"  width="50"/>
            <el-table-column prop="name" label="Nombre de la categoria" />
            <el-table-column prop="discount" label="Descuento " />

            <el-table-column fixed="right" label="" width="180">
                <template #default="scope">
                  <Link :href="route('category.edit', scope.row.id)"  >
                    <el-button
                    class="me-1"
                         size="mini"
                         type="primary">
                      Editar
                    </el-button>
                    </Link>
                    <el-button
                     type="danger"
                         size="mini"
                        @click="eliminarShow(scope.row.id)">
                      Eliminar
                    </el-button>

                </template>
            </el-table-column>
        </el-table>

        <el-divider></el-divider>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-for="link in categories.links" :key="link.id"
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

						</div>
					</div>

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
  </app-layout>
</template>

<script setup>

import {  ref, onUpdated , computed, onMounted} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import { Head, Link } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import { ElMessage } from 'element-plus'

const form = useForm({


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
