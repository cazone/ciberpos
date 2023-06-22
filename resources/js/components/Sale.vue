<template>
  <el-dialog  v-model="saleStore.centerDialogVisible"
    :show-close="true" title="Agregar venta" width="30%" center :close-on-click-modal="false">
    <el-row :gutter="20">
        <el-input

            v-model="saleStore.name"
            placeholder="Por favor, ingresa nombre del gasto"
            class="input-with-select"
            clearable>
</el-input>
    </el-row>
<el-divider></el-divider>
    <el-row >
        <el-input
v-model="saleStore.pay"
placeholder="Por favor, monto gastado"
class="input-with-select"

clearable
@keyup.enter="saleStore.save"
>
</el-input>

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
</style>
