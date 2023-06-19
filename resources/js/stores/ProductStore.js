import axios from 'axios';
import { watchDebounced } from '@vueuse/core'
import { defineStore } from 'pinia'
import { ref , watch, onMounted} from 'vue'
export const useProductStore = defineStore('product', () => {

    const centerDialogVisible = ref(false);
    const valSearch = ref('');
    const products = ref([]);
    const loading = ref(false);
    const currentRow = ref(null);

    const handleCurrentChange = (val) => {
        currentRow.value = val
      }
    const openDialog = () => {
    centerDialogVisible.value = true;
      };

      watchDebounced(
        valSearch,
        () => { search()},
        { debounce: 500, maxWait: 1000 },
      )

      const search = async () => {
        const res = await axios.post(route('product.search'),{search :valSearch.value } )
        products.value = res.data.data;
        console.log(products.value)
      };

    return {
        centerDialogVisible , openDialog,valSearch, products, loading, currentRow, handleCurrentChange
    }

});
