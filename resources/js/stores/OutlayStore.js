import axios from 'axios';

import { defineStore } from 'pinia'
import { ref , watch, onMounted} from 'vue'


export const useOutlayStore = defineStore('outlay', () => {

    const centerDialogVisible = ref(false);
    const name = ref('');
    const pay = ref(0);
    const loading = ref(false);
    const refNameOutlay = ref(null);

    const saveOutlay = async () => {
//TODO vaildar campos
        loading.value = true;
        await axios.post(route('outlay.store'), {
            name_outlay: name.value,
            total: pay.value

        }).then(response => {
            loading.value = false;
            ElMessage.success('Gasto Guardado');
            centerDialogVisible.value = false;
        }).catch(error => {
            loading.value = false;
            centerDialogVisible.value = false;
            ElMessage.error('Oops, No se puede guaradar.')


        });

    }

    const openDialog =  async () => {

        name.value = '';
        pay.value = '';

        centerDialogVisible.value = true;
      };

    return {
        centerDialogVisible, openDialog, name, pay, saveOutlay,  refNameOutlay, loading
    }

});
