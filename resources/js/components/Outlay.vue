<template>
  <el-dialog v-model="outlayStore.centerDialogVisible"
    :show-close="true" title="Agregar gasto" width="30%" center :close-on-click-modal="false">
    <el-row :gutter="20">
        <input
            v-model="outlayStore.name"
            type="text"
            placeholder="Por favor ingresa nombre del gasto"
           >

    </el-row>
<el-divider></el-divider>
    <el-row >
        <input
        type="text"

v-model="outlayStore.pay"
placeholder="Por favor ingresa monto del gasto"
@keyup.enter="outlayStore.saveOutlay"
:disabled="outlayStore.loading"

>


    </el-row>
    <template #footer>
      <span class="dialog-footer">
        <el-button @click="outlayStore.centerDialogVisible = false">Cancel</el-button>
        <el-button  :disabled="outlayStore.loading" v-loading="outlayStore.loading" type="primary" @click="outlayStore.saveOutlay">
          Guardar
        </el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useOutlayStore } from "@/stores/OutlayStore";
const outlayStore = useOutlayStore();






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
