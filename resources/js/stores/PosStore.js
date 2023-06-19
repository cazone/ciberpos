import axios from 'axios';
import { defineStore } from 'pinia'
import { ref , watch, onMounted} from 'vue'
import { useStorageAsync } from '@vueuse/core'
import { ElMessage } from 'element-plus'
import { t } from 'element-plus/lib/locale';
export const usePosStore = defineStore('pos', () => {

    const valSearch = ref('');
    const products = ref([]);
    const message = ref('');
    const loading = ref(false);
    const total = ref(0);
    const subtotal = ref(0);
    const discount = ref(0);
    const centerDialogVisible = ref(false);
    const ticket = ref(false);
    const pay = ref(0);
    const change = ref(0);


    const productsStorage = useStorageAsync('my-store',products.value);
onMounted(async () => {
     const local = localStorage.getItem('my-store');
    if (local.length > 0) {
        products.value = await JSON.parse(local);
    }
    productsStorage.value = products.value;
}),

    watch(pay, (newX) => {
        change.value = newX - total.value;
      })
    watch(
        products,
        (newValue, oldValue) => {
            loading.value = true;
            total.value = 0;
            discount.value = 0;
            subtotal.value = 0;

             products.value.forEach(item => {



              item.total = (item.price * item.amount) - item.discount;
              item.subtotal = item.price * item.amount;
              item.discount = item.price * item.amount * item.discountPorcent;
              subtotal.value += item.subtotal ;
              total.value += item.total;
              discount.value += item.discount;
            });
            loading.value = false;
            productsStorage.value = products.value;
         }, { deep: true })

    const openCenterDialog = () => {
        centerDialogVisible.value = true;
        pay.value = total.value;
    }
    const delAllProducts = () => {
        products.value = [];
    }
    const delProduct = (index) => {
        products.value.splice(index, 1);
    }
    const searchProduct = async() => {
        let searchArr = valSearch.value.split('*');

        loading.value = true;
    const { data } = await  axios.get(route('search'), {
            params: {
                query: searchArr[0]
            }
        });
       if (data.length == 0) {
        loading.value = false;
        ElMessage.error('Oops, No se encontro el producto.')
        return;

       }
       console.log(searchArr);
       const amount = searchArr[1] ? parseInt(searchArr[1]) : 1;
       const discountPorcent = 10 / 100
       const discount = (data[0].price * amount) * discountPorcent

       const  tempProducts = {
            id: data[0].id,
            name_product: data[0].name_product,
            price: data[0].price,
            amount: amount,
            discount: discount,
            discountPorcent: discountPorcent,
            subtotal: data[0].price * amount,
            total: data[0].price * amount - discount
        };

        await  products.value.push(tempProducts);

        loading.value = false;
        valSearch.value = '';
    }

    const saveInvoice = async() => {
        axios.post(route('invoice.store'), {
            products: products.value,
            total: total.value,
            discount: discount.value,
            subtotal: subtotal.value,
        }).then(function (response) {
           if(response.data.success){
            ElMessage.success('Factura guardada correctamente.')
            products.value = [];
            centerDialogVisible.value = false;
           }
        }).catch(function (error) {
            console.log(error);
            ElMessage.error('Oops, Algo salio mal.')
            centerDialogVisible.value = false;
        });


    }


    return {valSearch, searchProduct, products, message, loading, total, delProduct,
        delAllProducts, discount, centerDialogVisible, ticket, change, pay, openCenterDialog,
        subtotal, saveInvoice
    }

})
