<template>
	<div>
		<h5 class="text-white">
			Ventas
			<a href="#" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#create" title="Agregar"><i class="fas fa-plus-circle"></i></a>
		</h5>
		<NewSale></NewSale>

		<div class="row mt-3">
			<div class="col-2">
				
					<Datepicker valueType="format" :inline="true" v-model="calendar.search"/>
					<div class="row">
						<div class="col-6 pr-0">
							<button class="btn btn-success btn-block" style="border-radius: 0;" @click.prevent="allSalesCalendar"><i class="fas fa-search"></i></button>
						</div>
						<div class="col-6 pl-0">
							<button class="btn btn-danger btn-block" style="border-radius: 0;" @click.prevent="allSales"><i class="fas fa-times"></i></button>
				        </div>	
					</div>
				
			</div>
			<div class="col-10">
				<table class="table table-borderless table-dark table-hover table-striped">
					<thead>
						<tr>
							<th>Producto</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Utilidad</th>
							<th>Neto</th>
							<th>Total</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody v-for="sale in sales" :key="sale.id">
						<tr class="accordion-toggle" data-toggle="collapse" :data-target="'#sale'+sale.id">
							<td style="width: 25%"></td>
							<td style="width: 10%"></td>
							<td style="width: 10%"></td>
							<td style="width: 10%"></td>
							<td style="width: 10%"></td>
							<td style="width: 10%">{{ sale.total | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
							<td>{{ sale.updated_at }}</td>
						</tr>
						<tr v-for="product in sale.products" :key="product.id" :id="'sale'+sale.id" class="accordian-body collapse">
							<td style="width: 25%">{{ product.code_id }}</td>
							<td style="width: 10%">{{ product.price | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
							<td style="width: 10%">{{ product.quantity }}</td>
							<td style="width: 10%">{{ parseInt( product.utility*100)+'%' }}</td>
							<td style="width: 10%">{{ Math.round(((parseFloat(product.price * product.quantity)) * parseFloat(product.utility)) + parseFloat(product.price * product.quantity)) | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
							<td style="width: 10%">{{ Math.round((((parseFloat(product.price * product.quantity)) * parseFloat(product.utility)) + parseFloat(product.price * product.quantity)) * 1.19) | currency('$', 0, { thousandsSeparator: '.' })}}</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'
//import Datepicker from 'vuejs-datetimepicker'
import Datepicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/es';
import NewCode from './NewCode'
import ReadCode from './ReadCode'
import NewSale from './NewSale'



export default {
	components : { NewCode, ReadCode, NewSale, Datepicker},
	computed: {
		...mapState(['cart', 'calendar', 'cartValue', 'cartTotal', 'sales', 'productSales']),
	},
	methods: {
		...mapActions(['newSale', 'allSalesCalendar', 'allSales', 'removeFromCart'])
	},
	created() {
		this.$store.dispatch('allSalesCalendar')
	},
	
}
</script>

<style>
.mx-btn{
	color: #fff;
}
.mx-datepicker-main {
	color: #fff;
	background-color: #343a40;
	border: 0;
}
.mx-calendar{
	width: 100%;
}
.mx-input {
	display: block;
    width: 100%;
	height: calc(1.6em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>