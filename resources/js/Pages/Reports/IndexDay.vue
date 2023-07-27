<template>
  <app-layout title="Lista">
    <template #header>

    </template>
    <div class="page-header">
						<div class="page-title">
							<h4>Reporte de ventas por dia</h4>
							<h6>Ver/Buscar categoría de producto</h6>
						</div>
						<!-- <div class="page-btn">
							<Link :href="route('category.create')"  class="btn btn-added">
								<img src="assets/img/icons/plus.svg"  class="me-1" alt="img">Nueva Categoria
							</Link>
						</div> -->
					</div>
                    <div class="row">
<div class="col-lg-12 col-sm-12 col-12">
    <Line
    id="my-chart-id"
    :options="options"
    :data="data1"
  />

</div>
</div>
  </app-layout>
</template>

<script setup>

import {  ref, onUpdated , computed, onMounted} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import { Head, Link } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import { ElMessage } from 'element-plus'
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)


const data1 = ref({
  labels: usePage().props.value.labels,
  datasets: [
    {
      label: 'Ventas',
      backgroundColor: '#2ECC71',
      data:  usePage().props.value.data
    }
  ]})

  const options = {
  responsive: true,
  maintainAspectRatio: false


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

const flash = computed(() => usePage().props.value.flash.success)
const reportDay = computed(() => usePage().props.value.reportDay)
const labels = computed(() => usePage().props.value.labels)
const data2 = computed(() => usePage().props.value.data)
</script>
