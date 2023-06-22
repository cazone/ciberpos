<template>
  <el-dialog v-model="outlayStore.centerDialogVisible"
    :show-close="true" title="Agregar gasto" width="30%" center :close-on-click-modal="false">
    <el-row :gutter="20">
        <el-input

            v-model="outlayStore.name"
            placeholder="Por favor, ingresa nombre del gasto"
            class="input-with-select"
            clearable>
</el-input>
    </el-row>
<el-divider></el-divider>
    <el-row >
        <el-input
        v-loading="loading"
v-model="outlayStore.pay"
placeholder="Por favor, monto gastado"
class="input-with-select"
@keyup.enter="outlayStore.saveOutlay"
clearable
>
</el-input>

    </el-row>
    <template #footer>
      <span class="dialog-footer">
        <el-button @click="outlayStore.centerDialogVisible = false">Cancel</el-button>
        <el-button   v-loading="outlayStore.loading" type="primary" @click="outlayStore.saveOutlay">
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

</style>
