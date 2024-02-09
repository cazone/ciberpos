<template>
  <app-layout title="Nueva Categoria">
    <template #header> </template>

    <div class="page-header">
      <div class="page-title">
        <h4>Compras de mercacia</h4>
        <h6>Crear lista de compras</h6>
      </div>
    </div>
    <SearchProduct />
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="form-group">
              <label>Buscar Producto</label>
              <el-input
                ref="refSearch"
                @keydown.enter="searchProduct"
                v-model="valSearch"
                placeholder="Por favor, ingresa clave o codigo de barra del producto"
                class="input-with-select"
                clearable
              >
              </el-input>
              <el-button   @click="productStore.openDialog">Buscar por nombre</el-button>
              <div>
                <h6 class="manitoryblue">{{ message }}</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12"></div>
          <div class="col-lg-3 col-sm-6 col-12"></div>
          <div class="col-lg-6 col-sm-12">
            <div v-loading="processing" class="productdetails productdetailnew">
              <ul class="product-bar">
                <li>
                  <h4>Nombre del producto</h4>
                  <h6 class="manitorygreen">{{ product?.name_product }}</h6>
                </li>
                <li>
                  <h4>Existencia</h4>
                  <h6 class="manitorygreen">{{ product?.quantity }}</h6>
                </li>
                <li>
                  <h4>Precio</h4>
                  <h6 class="manitorygreen">
                    {{ numeralFormat(product?.price, "$ 0,0[.]00") }}
                  </h6>
                </li>
                <li>
                  <h4>Costo Producto</h4>
                  <div class="form-group">
                    <el-input
                      ref="refCostProduct"
                      @keydown.enter="preiceProduct"
                      v-model="costProduct"
                      placeholder="Por favor, ingresa consto"
                      class="input-with-select"
                      :disabled="!product"
                    >
                    </el-input>
                  </div>
                </li>
                <li>
                  <h4>Cantidad comprada</h4>
                  <div class="form-group">
                    <el-input
                      ref="refCount"
                      @keydown.enter="utilityProduct"
                      v-model="count"
                      placeholder="Por favor, ingresa cantidad"
                      class="input-with-select"
                      :disabled="!costProduct"
                    >
                    </el-input>
                  </div>
                </li>
                <li>
                  <h4>Utilidad %</h4>
                  <div class="form-group">
                    <el-input
                      ref="refUtility"
                      v-model="utility"
                      placeholder="Por favor, ingresa cantidad"
                      class="input-with-select"
                      :disabled="!costProduct"
                    >
                    </el-input>
                  </div>
                </li>
                <li>
                  <h4>Precio Publico   </h4>

                    <div class="form-group">
                     <el-input
                      ref="refTotal"

                      v-model="total"
                      placeholder="Por favor, ingresa consto"
                      class="input-with-select"
                      :disabled="!product"
                    >
                    </el-input>
                    </div>
                    <el-checkbox v-model="isUpdatePrice" label="Actualizar precio" size="large" />
                    <!-- <h6 class="manitoryblue">Si esta habilitado el precio se actualiza con el valos del precio publico</h6> -->



                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <el-button @click="onSumit" type="success">Guardar</el-button>
        </div>
        <el-divider></el-divider>
        <div class="col-lg-12">
          <el-table
            :data="products"
            style="width: 100%"
            height="400"
            highlight-current-row
          >
            <el-table-column type="index" width="50" />
            <el-table-column prop="id" label="ID" />
            <el-table-column prop="product" label="Producto" >
            <template #default="scope">
                  {{scope.row.product.name_product}}
                </template>
              </el-table-column>
            <el-table-column prop="quantity" label="Existencia actual" >
            <template #default="scope">
                  {{scope.row.product.quantity}}
                </template>
              </el-table-column>
            <el-table-column prop="price" label="Precio" >
            <template #default="scope">
                  {{numeralFormat(scope.row.product.price, "$ 0,0[.]00") }}
                </template>
              </el-table-column>
            <el-table-column prop="price" label="Costo" >
            <template #default="scope">
                  {{numeralFormat(scope.row.price, "$ 0,0[.]00") }}
                </template>
              </el-table-column>
            <el-table-column prop="amount" label="Cantidad comprado" >
            <template #default="scope">
                  {{scope.row.amount}}
                </template>
              </el-table-column>
              <el-table-column fixed="right" label="" width="60">
                                <template #default="scope">
                                    <el-button
                                        icon="fa fa-trash"
                                        @click="
                                            delProduct(scope.row.id)
                                        "
                                        size="small"
                                        circle
                                    />
                                </template>
                            </el-table-column>
          </el-table>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script setup>
import { onMounted, ref, watch, computed } from "vue";
import { storeToRefs } from 'pinia'
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import SearchProduct from "@/components/SearchProduct.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { usePage } from "@inertiajs/inertia-vue3";
import { useProductStore } from "@/stores/ProductStore";


const productStore = useProductStore();
const { currentRow} = storeToRefs(productStore)
const products = computed(() => usePage().props.value.products);
const valSearch = ref(null);
const processing = ref(false);
const product = ref(null);
const refSearch = ref(null);
const costProduct = ref(null);
const refCostProduct = ref(null);
const count = ref(1);
const refCount = ref(null);
const refTotal = ref(null);
const utility = ref(50);
const refUtility = ref(null);
const total = ref(0);
const message = ref("");
const isUpdatePrice = ref(false);



const form = useForm({
  price: costProduct.value,
  amount: count.value,
  percent: utility.value,
  product_id: product.value?.id,
  isUpdatePrice: isUpdatePrice.value,
  total: total.value,
});

onMounted(() => {
  refSearch.value.focus();

});

watch(currentRow, (val) => {
    product.value = {
        id: val.id,
        name_product: val.name_product,
        quantity: val.quantity,
        price: val.price,

    };
    refCostProduct.value.focus();

});
watch(costProduct, (val) => {
  total.value = val * 1 * (utility.value / 100) + val * 1;
});
watch(count, (val) => {
//   total.value =
//     costProduct.value * val * (utility.value / 100) + costProduct.value * 1;
});
watch(utility, (val) => {
  total.value =
    costProduct.value * 1 * (val / 100) +
    costProduct.value * 1;
});

const preiceProduct = () => {
  refCount.value.focus();
  refCount.value.select();
};

const utilityProduct = () => {
  refUtility.value.focus();
  refUtility.value.select();
};

const delProduct = (id) => {
  form.delete(route("shopping.destroy", id));
};
const onSumit = () => {
  form.amount = count.value;
  form.percent = utility.value;
  form.price = costProduct.value;
  form.product_id = product.value?.id;
  form.isUpdatePrice = isUpdatePrice.value;
  form.total = total.value;

  form.post(route("shopping.store"));
};

const searchProduct = async () => {
  message.value = "";
  processing.value = true;
  const { data } = await axios.get(route("product.show", valSearch.value));
  console.log(data.data);
  if (data.data == null) {
    message.value = "Producto no encontrado";
    processing.value = false;
    valSearch.value = "";

    return;
  }
  product.value = data.data;
  refCostProduct.value.focus();
  processing.value = false;
};
</script>
