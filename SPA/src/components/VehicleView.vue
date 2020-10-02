<template>
    <div class="container">
        <div class="row pt-5">
            <div class="list-view col-md-8">
                <div class="container">
                <h2>Vehicle View</h2>
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">UID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Engine Displacement</th>
                        <th scope="col">Engine Power</th>
                        <th scope="col">Price</th>
                        <th scope="col">Location</th>
                    </tr>
                    </thead>
                    <tbody v-for="vehicle in vehicles" :key="vehicle.id">
                    <tr>
                        <td>{{vehicle.unique_identifier}}</td>
                        <td>{{vehicle.name}}</td>
                        <td class="text-center">{{vehicle.engine_displacement}}</td>
                        <td class="text-center">{{vehicle.engine_power}}</td>
                        <td class="text-center">{{vehicle.price}}</td>
                        <td>{{vehicle.location}}</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="form-view col-md-4">
                <div class="container">
                <h2>Vehicle Form</h2>
                    <form>
                    <div class="form-group">
                        <label for="uid">Uniqe Identifier (UID)</label>
                        <input type="text" class="form-control" id="unique_identifier" placeholder="Uniqe Identifier" v-model="vehicleForm.unique_identifier">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" v-model="vehicleForm.name">
                    </div>
                    <div class="form-group">
                        <label for="engineDisplacement">Engine Displacement</label>
                        <input type="text" class="form-control" id="engine_displacement" placeholder="Engine Displacement" v-model="vehicleForm.engine_displacement">
                    </div>
                    <div class="form-group">
                        <label for="enginePower">Engine Power</label>
                        <input type="text" class="form-control" id="engine_power" placeholder="Engine Power" v-model="vehicleForm.engine_power">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" v-model="vehicleForm.price">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" placeholder="Location" v-model="vehicleForm.location">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3" @click="addData"> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VechicleService from "../services/VehicleService";

export default {
    name: 'VehicleView',
    data(){
        return{
            vehicles: [],
            vehicleForm : {
                unique_identifier : '',
                name : '',
                engine_displacement : '',
                engine_power : '',
                price : '',
                location : ''
            }
        }
    },
    mounted() {
        this.load()
    },
    methods: {
        load(){
            VechicleService.getData()
                .then(res => {
                    this.vehicles = res.data.vehicle;
                })
                .catch( e => {
                    console.log(e);
                })
        },
        addData() {
        var data = {
            unique_identifier : this.vehicleForm.unique_identifier,
            name : this.vehicleForm.name,
            engine_displacement : this.vehicleForm.engine_displacement,
            engine_power : this.vehicleForm.engine_power,
            price : this.vehicleForm.price,
            location : this.vehicleForm.location
        };

        VechicleService.insertData(data)
            .then(res => {
                console.log(res.data.vehicle)
                this.load()
            })
                .catch(e => {
                console.log(e);
            });
        },
    }
    }
</script>