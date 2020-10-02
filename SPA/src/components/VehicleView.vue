<template>
    <div class="container">
        <div class="row pt-5">
            <div class="list-view col-md-8">
                <div class="container">
                <h2>Vehicle View</h2>
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">NO</th>
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
                        <td scope="row">1</td>
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
                        <input type="text" class="form-control" id="uid" placeholder="Uniqe Identifier">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="engineDisplacement">Engine Displacement</label>
                        <input type="text" class="form-control" id="engineDisplacement" placeholder="Engine Displacement">
                    </div>
                    <div class="form-group">
                        <label for="enginePower">Engine Power</label>
                        <input type="text" class="form-control" id="enginePower" placeholder="Engine Power">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" placeholder="Location">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
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
            vehicles: []
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
        }
    }
    }
</script>