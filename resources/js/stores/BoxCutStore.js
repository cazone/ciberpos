import axios from 'axios';

import { defineStore } from 'pinia'
import { ref , watch, onMounted} from 'vue'
import { ElMessage } from 'element-plus'

export const useBoxCutStore = defineStore('boxCut', () => {

     const centerDialogVisible = ref(false);
     const loading = ref(false);
     const resumen = ref([]);
     const cash = ref('');
     const totalUser = ref(0);

    watch(cash, (value) => {
        totalUser.value  =  resumen.value.total - value;
    });

    onMounted(() => {

    });

    const loadResumen = async () => {
        loading.value = true;
        await axios.post(route('boxcut.resume')).then(response => {
            loading.value = false;
            console.log(response.data);
            resumen.value = response.data.data;
        }).catch(error => {
            loading.value = false;
            ElMessage.error('Oops, No se puede guardar.')
        });
    }

    const save = async () => {
//TODO vaildar campos
        loading.value = true;
        await axios.post(route('boxcut.store'), {
            'sale' : resumen.value.sale,
            'invoice' : resumen.value.invoice,
            'outlay' : resumen.value.outlay,
            'cash' : cash.value,
            'total' : totalUser.value


        }).catch(error => {
            loading.value = false;
            ElMessage.error('Oops, No se puede guaradar.')

        });
        centerDialogVisible.value = false;
        loading.value = false;
    }
    // const refInput = (val) => {
    //     refNameOutlay.value = val;
    // }
    const openDialog =  async () => {

        await loadResumen();
        centerDialogVisible.value = true;
      };

    return {
        centerDialogVisible, openDialog, loading, resumen, cash, totalUser, save
    }

});
