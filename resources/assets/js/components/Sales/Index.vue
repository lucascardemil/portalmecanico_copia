<template>
<div>
	<div class="row">
		<h5 class="text-white">
			Ventas
			<a href="#" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#create" title="Agregar"><i class="fas fa-plus-circle"></i></a>
		</h5>
	</div>
	<new-sale />



	<!-- <div>
	  <h5 class="text-white">Administrar Ventas</h5>
	  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item">
		  <a 
			class="nav-link active" 
			id="pills-home-tab" 
			data-toggle="pill"
			href="#pills-home" 
			role="tab" 
			aria-controls="pills-home"
			aria-selected="true"
		  >Agregar desde Lector</a>
		</li>
		<li class="nav-item">
		  <a 
			class="nav-link" 
			id="pills-profile-tab" 
			data-toggle="pill"
			href="#pills-profile" 
			role="tab" 
			aria-controls="pills-profile"
			aria-selected="false"
		  >Agregar Manualmente</a>
		</li>
	  </ul>
	  <div class="tab-content p-3" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  <read-code />
		</div>
		<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
		  <new-code />
		</div>
	  </div>
	</div>
	<div>
	  <label/>
	  <h5 class="text-white">Carro de Compras</h5>
	  <table class="table table-borderless table-dark table-hover table-striped mt-3 table-sm">
		<thead>
		  <tr>
			<th>Producto</th>
			<th>Precio</th>
			<th>Utilidad</th>
			<th>Cantidad</th>
			<th>Valor Neto</th>
			<th>Valor Total</th>
			<th>Acción</th>
		  </tr>
		</thead>
		<tbody>
		  <tr v-for="product in cart" :key="product.product.value">
			<td>{{product.product.label}}</td>
			<td>{{product.price.label | currency('$', 0, { thousandsSeparator: '.' })}}</td>
			<td>{{product.utility+'%'}}</td>
			<td>{{product.quantity}}</td>
			<td>{{product.value | currency('$', 0, { thousandsSeparator: '.' })}}</td>
			<td>{{product.total | currency('$', 0, { thousandsSeparator: '.' })}}</td>
			<td>
			  <div class="col-lg-5 mt-1">
				<a 
				  href="#" 
				  class="btn btn-danger btn-sm"
				  @click.prevent="removeFromCart( { id: product.code.value } )"
				  data-toggle="tooltip"
				  data-placement="top"
				  title="Eliminar"
				>
				  <i class="fas fa-ban"></i>
				</a>
			  </div>
			</td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>{{cartValue | currency('$', 0, { thousandsSeparator: '.' })}}</td>
			<td>{{cartTotal | currency('$', 0, { thousandsSeparator: '.' })}}</td>
			<td>
			  <div class="col-lg-6 mt-1">
				<button :disabled="cartValue===0" v-on:click="newSale" class="btn btn-success form-control">
				  <i class="fas fa-check"></i> Realizar Venta
				</button>
			  </div>
			</td>
		  </tr>
		</tbody>
	  </table>
	</div> -->
	<div class="row mt-3">
		<table class="table table-borderless table-dark table-hover table-striped mt-3 table-sm">
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
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>{{ sale.total | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
					<td>{{ sale.updated_at }}</td>
				</tr>
				<tr v-for="product in sale.products" 
					:key="product.id">
					<td>{{ product.code_id }}</td>
					<td>{{ product.price | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
					<td>{{ product.quantity }}</td>
					<td>{{ parseInt( product.utility*100)+'%' }}</td>
					<td>{{ Math.round( parseFloat( product.price*(1+product.utility)*product.quantity)) | currency('$', 0, { thousandsSeparator: '.' })}}</td>
					<td>{{ Math.round( parseFloat( product.price*(1+product.utility)*product.quantity*1.19)) | currency('$', 0, { thousandsSeparator: '.' })}}</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'
import NewCode from './NewCode'
import ReadCode from './ReadCode'
import NewSale from './NewSale'

export default {
  components : { NewCode, ReadCode, NewSale },
  computed: {
	...mapState(['cart', 'cartValue', 'cartTotal', 'sales', 'productSales'])
  },
  methods: {
	...mapActions(['newSale', 'removeFromCart'])
  },
  created() {
	this.$store.dispatch('allSales')
  }
}
</script>