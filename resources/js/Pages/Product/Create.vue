<template>
    <app-layout title="Nueva Categoria">
        <template #header> </template>

        <div class="page-header">
            <div class="page-title">
                <h4>Añadir nuevo producto</h4>
                <h6>Crear nuevo producto</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="submitForm">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nombre de categoria</label>
                                <jet-input id="name" type="text" v-model="form.name_product"
                                    :class="{ 'is-invalid': form.errors.name_product }" autocomplete="name_product" />
                                <jet-input-error :message="form.errors.name_product" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">

                                <jet-label for="local_id" value="Categoria" />
                                <el-select   v-model="form.category_id" style="width: 100%" placeholder="Selecciona">
                                    <el-option id="category_id" v-for="item in categories" :key="item.id" :label="item.name"
                                        :value="item.id" />
                                </el-select>
                                <jet-input-error :message="form.errors.category_id" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <jet-label for="local_id" value="Unidad" />
                                <el-select v-model="form.unit" style="width: 100%">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label"
                                        :value="item.value" />
                                </el-select>
                                <jet-input-error :message="form.errors.unit" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Codigo</label>
                                <jet-input id="code" type="text" v-model="form.code"
                                    :class="{ 'is-invalid': form.errors.code }" autocomplete="code" />
                                <jet-input-error :message="form.errors.code" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Codigo de Barras</label>
                                <jet-input id="barcode" type="text" v-model="form.barcode"
                                    :class="{ 'is-invalid': form.errors.barcode }" autocomplete="barcode" />
                                <jet-input-error :message="form.errors.barcode" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>SKU</label>
                                <jet-input id="sku" type="text" v-model="form.sku"
                                    :class="{ 'is-invalid': form.errors.sku }" autocomplete="sku" />
                                <jet-input-error :message="form.errors.sku" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Stok minimo</label>
                                <jet-input id="minimum_qty" type="text" v-model="form.minimum_qty"
                                    :class="{ 'is-invalid': form.errors.minimum_qty }" autocomplete="minimum_qty" />
                                <jet-input-error :message="form.errors.minimum_qty" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Stok</label>
                                <jet-input id="quantity" type="text" v-model="form.quantity"
                                    :class="{ 'is-invalid': form.errors.quantity }" autocomplete="quantity" />
                                <jet-input-error :message="form.errors.quantity" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Descripcion</label>
                                <jet-input id="description" type="textarea" v-model="form.description"
                                    :class="{ 'is-invalid': form.errors.description }" autocomplete="description" />
                                <jet-input-error :message="form.errors.description" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Precio al publico</label>
                                <jet-input id="price" type="text" v-model="form.price"
                                    :class="{ 'is-invalid': form.errors.price }" autocomplete="price" />
                                <jet-input-error :message="form.errors.price" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Costo</label>
                                <jet-input id="cost" type="text" v-model="form.cost"
                                    :class="{ 'is-invalid': form.errors.cost }" autocomplete="cost" />
                                <jet-input-error :message="form.errors.cost" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Marcar como favorito</label>
                                <el-switch v-model="form.favorite" class="ml-2" inline-prompt
                                    style="--el-switch-on-color: #13ce66; --el-switch-off-color: #ff4949" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Notificar Stock minimo</label>
                                <el-switch v-model="form.notification_minimum_qty" class="ml-2" inline-prompt
                                    style="--el-switch-on-color: #13ce66; --el-switch-off-color: #ff4949" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <jet-button :class="{ 'text-white-50': form.processing }" class="btn btn-submit me-2"
                                :disabled="form.processing">
                                <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Cargando...</span>
                                </div>
                                Guardar
                            </jet-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import { ref, computed } from "vue";
import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";
const categories = computed(() => usePage().props.value.categories)
const form = useForm({
    name_product: null,
    category_id: null,
    unit: 'Unidad',
    code: null,
    barcode: null,
    sku: null,
    minimum_qty: 0,
    quantity: 0,
    description: null,
    price: 0,
    cost: 0,
    favorite: false,
    notification_minimum_qty: false,
});
const options = [
    {
        value: 'Unidad',
        label: 'Unidad',
    },
    {
        value: 'Fraccion',
        label: 'Fraccion(Kilo, Metro , Litro, Etc)',
    }
]
const submitForm = () => {
    form.post(route("product.store"), {});
};
</script>
