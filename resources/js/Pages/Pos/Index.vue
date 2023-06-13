<template>
  <app-layout title="Lista">
    <template #header>
    </template>

    <div class="common-layout">
    <el-container>

      <el-header>
        <el-input

      v-model="posStore.valSearch"
      placeholder="Por favor, ingresa clave o codigo de barra del producto"
      class="input-with-select"
      @keyup.enter="posStore.searchProduct"
      clearable
    >


    </el-input>
      </el-header>
      <el-container>
        <el-aside width="20%" >

        </el-aside>
        <el-main  >
            <div class="totalitem">
										<h4>Total items : {{ posStore.products.length }}</h4>
										<a href="javascript:void(0);">Borrar todo</a>
									</div>
            <el-table v-loading="posStore.loading" :data="posStore.products" style="width: 100%"    height="400"  highlight-current-row>
                <el-table-column type="index" width="50" />
    <el-table-column prop="name_product" label="Producto" />
    <el-table-column prop="amount" label="Cantidad" width="250">
        <template #default="scope">
            <el-input-number v-model="scope.row.amount" :min="1" :max="10"  size="small"/>
        </template>
    </el-table-column>
    <el-table-column prop="price" label="Precio"  />
    <el-table-column fixed="right" label="" width="60">
                <template #default="scope">
                    <el-button icon="fa fa-trash"  size="small" circle  />

                </template>
                </el-table-column>

  </el-table>
  <div class="card-body pt-0 pb-2">
									<div class="setvalue">
										<ul>
											<li>
												<h5>Subtotal </h5>
												<h6>55.00$</h6>
											</li>
											<li>
												<h5>Tax </h5>
												<h6>5.00$</h6>
											</li>
											<li class="total-value">
												<h5>Total  </h5>
												<h6>60.00$</h6>
											</li>
										</ul>
									</div>
									<div class="setvaluecash">
										<ul>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/cash.svg" alt="img" class="me-2">
													Cash
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/debitcard.svg" alt="img" class="me-2">
													Debit
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/scan.svg" alt="img" class="me-2">
													Scan
												</a>
											</li>
										</ul>
									</div>
									<div class="btn-totallabel">
										<h5>Checkout</h5>
										<h6>60.00$</h6>
									</div>
									<div class="btn-pos">
										<ul>
											<li>
												<a class="btn"><img src="assets/img/icons/pause1.svg" alt="img" class="me-1">Hold</a>
											</li>
											<li>
												<a class="btn"><img src="assets/img/icons/edit-6.svg" alt="img" class="me-1">Quotation</a>
											</li>
											<li>
												<a class="btn"><img src="assets/img/icons/trash12.svg" alt="img" class="me-1">Void</a>
											</li>
											<li>
												<a class="btn"><img src="assets/img/icons/wallet1.svg" alt="img" class="me-1">Payment</a>
											</li>
											<li>
												<a class="btn"  data-bs-toggle="modal" data-bs-target="#recents"><img src="assets/img/icons/transcation.svg" alt="img" class="me-1"> Transaction</a>
											</li>
										</ul>
									</div>
								</div>
        </el-main>
      </el-container>
      <el-footer>

        <div class="setvaluecash">
										<ul>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/cash.svg" alt="img" class="me-2">
													Total
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/debitcard.svg" alt="img" class="me-2">
													Debit
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/scan.svg" alt="img" class="me-2">
													Scan
												</a>
											</li>
										</ul>
									</div>

                                    </el-footer>
    </el-container>
  </div>
  </app-layout>
</template>
<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue"
import { Head, Link } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import { ElMessage } from 'element-plus'
import { usePosStore } from "@/stores/PosStore";


const posStore = usePosStore();

const input3 = ref('')
const select = ref('')

const tableData = [
  {
    date: '2016-05-03',
    name: 'Tom',
    address: 'No. 189, Grove St, Los Angeles',
  },
  {
    date: '2016-05-02',
    name: 'Tom',
    address: 'No. 189, Grove St, Los Angeles',
  },
  {
    date: '2016-05-04',
    name: 'Tom',
    address: 'No. 189, Grove St, Los Angeles',
  },
  {
    date: '2016-05-01',
    name: 'Tom',
    address: 'No. 189, Grove St, Los Angeles',
  },
]

</script>
