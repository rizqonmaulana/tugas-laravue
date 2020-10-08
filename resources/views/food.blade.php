<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .completed{
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    <div id="app">
        <h3>Best Food in The World List</h3>
        <input type="text" v-model="newFood" placeholder="enter food name">
        <input type="text" v-model="country" @keyup.enter="addFood" placeholder="enter country name">
        <table>
            <tr>
                <td v-for="(food, index) in foods"></td>
                <td></td>
            </tr>
        </table>
        <ul>
            <li v-for="(food, index) in foods">
                <span> @{{ food.name }} </span>
                <span> from </span>
                <span> @{{ food.country }} </span>
                <button type="button" v-on:click="removeFood(index, food)">Delete</button>
                <button type="button" v-on:click="editFood(food)">Edit</button>
            </li>
        </ul>
        <p>cara edit : masukan value yang baru pada kolom input lalu klik edit pada data yang ingin diubah</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
    <script>
        new Vue({
            el:"#app",
            data:{
                newFood : "",
                country : "",
                foods : []
            },
            methods: {
                addFood : function(){
                    let foodInput = this.newFood.trim();
                    let countryInput = this.country.trim();
                    if(foodInput){
                        this.$http.post('/api/food', {name: foodInput, country: countryInput}).then(response => {
                            this.foods.unshift(
                            {name: foodInput, country: countryInput}
                        )
                        this.newFood = "",
                        this.country = ""
                        });
                    }
                },
                removeFood : function(index, food){
                    this.$http.post('/api/food/delete/' + food.id).then(response => {
                            if(confirm('want to delete this data ?')){
                                this.foods.splice(index, 1)
                            }
                        });

                },
                editFood : function(food){
                    let foodInput = this.newFood.trim();
                    let countryInput = this.country.trim();
                    this.$http.post('/api/food/edit/' + food.id, {name: foodInput, country: countryInput}).then(response => {
                            food.name = foodInput
                            food.country = countryInput
                            this.foods(
                            {name: foodInput, country: countryInput}
                        )
                        });
                }
            },
            mounted() {
                // GET /someUrl
                this.$http.get('/api/food').then(response => {
                    let result = response.body.data;
                    this.foods = result
                });
            },
        });
    </script>
</body>
</html>
