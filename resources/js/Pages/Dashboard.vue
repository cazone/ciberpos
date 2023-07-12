<template>
  <app-layout title="Dashboard">
    <template #header>

    </template>
    <div class="row">
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>{{numeralFormat(outlay_day, '$ 0,0[.]00') }}</h5>
<h6>Total Gastos Diaria</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash1">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>{{numeralFormat(sales_day, '$ 0,0[.]00') }}</h5>
<h6>Total Venta Diaria</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash2">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash3.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>{{numeralFormat(sales, '$ 0,0[.]00') }}</h5>
<h6>Total Ventas Mensual</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash3">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash4.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
    <h5>{{numeralFormat(outlay, '$ 0,0[.]00') }}</h5>
<h6>Total Gastos Mensual</h6>
</div>
</div>
</div>




</div>
<div class="card-body">
<h4 class="card-title">Productos Vendidos</h4>
<el-table :data="invoices.data"  style="width: 100%">
        <el-table-column  fixed  prop="id" label="ID" width="60" />
        <el-table-column prop="product" label="Nombre producto">
                <template #default="scope">
                  {{ (scope.row.product) ? scope.row.product.name_product : '' }}
                </template>
            </el-table-column>

            <el-table-column    prop="price" label="Precio" width="100" >

                <template #default="scope">
                  {{ numeralFormat(scope.row.price, "$ 0,0[.]00" ) }}
                </template>


            </el-table-column>
            <el-table-column    prop="amount" label="Cantidad" width="100" />
            <el-table-column    prop="total" label="Total" width="100">
                <template #default="scope">
                  {{ numeralFormat(scope.row.total, "$ 0,0[.]00" ) }}
                </template>


            </el-table-column>
            <el-table-column    prop="created_at" label="Fecha"  >
                <template #default="scope">
                  {{  moment(scope.row.created_at).lang("es").format("MMMM D, h:mm:ss a")}}
                </template>
            </el-table-column>
            <el-table-column prop="ussr_id" label="Vendio">
                <template #default="scope">
                  {{  scope.row.user.name }}
                </template>
            </el-table-column>


        </el-table>

        <el-divider></el-divider>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-for="link in invoices.links" :key="link.id"
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
  </app-layout>
</template>

<script setup >
import moment from "moment";
import {  ref , computed} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from '@/Jetstream/Button.vue';
import { useForm } from '@inertiajs/inertia-vue3'
import Pagination from '@/components/Pagination.vue'
import { Inertia } from "@inertiajs/inertia";
import { usePage } from '@inertiajs/inertia-vue3'
const sales = computed(() => usePage().props.value.sales)
const mes = computed(() => usePage().props.value.mes)
const sales_day = computed(() => usePage().props.value.sales_day)
const outlay_day = computed(() => usePage().props.value.outlay_day)
const outlay = computed(() => usePage().props.value.outlay)
const invoices = computed(() => usePage().props.value.invoices)

</script>
