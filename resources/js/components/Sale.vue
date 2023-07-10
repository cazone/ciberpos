<template>
  <el-dialog  v-model="saleStore.centerDialogVisible"
    :show-close="true" title="Agregar venta" width="30%" center :close-on-click-modal="false">
    <el-row :gutter="20">
        <input
            type="text"
            v-model="saleStore.name"
            placeholder="Por favor ingresa nombre de lo vendido"

            >

    </el-row>
<el-divider></el-divider>
    <el-row >
        <input
        type="numbre"
v-model="saleStore.pay"
placeholder="Por favor ingresa monto vendido"

@keyup.enter="saleStore.save"
>


    </el-row>
    <template #footer>
      <span class="dialog-footer">
        <el-button @click="saleStore.centerDialogVisible = false">Cancel</el-button>

        <el-button       v-loading="saleStore.loading" type="primary" @click="saleStore.save">
          Guardar
        </el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useSaleStore } from "@/stores/SaleStore";
const saleStore = useSaleStore();


// onMounted(() => {

// console.log('com' ,refName.value);
//     saleStore.refInput(refName.value );

// })




</script>

<style lang="scss" scoped>

input:focus {
    outline: none !important;
    border-color: #719ECE;
    box-shadow: 0 0 10px #719ECE;
    background-color: aquamarine;
 }
 input {
    border: 2px solid red;
                     border-radius: 4px; width: 100%; height: 50px; font-size: 22px;
 caret-color: red;
 caret-color: #ff0000;
 caret-color: rgb(255, 0, 0);
 caret-color: hsl(0, 97%, 50%);
}
</style>
