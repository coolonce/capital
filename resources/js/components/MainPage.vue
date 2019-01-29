<template>
    
    <div class="container ">      
        <div class="row justify-content-center ">
            <div class="col-md-8 ">
                <div class="card card-default" v-for="photo in photos" style="margin-top:20px;">
                    <div class="card-header" v-if="photo.title != ' '">{{photo.title}}</div>
                    <div class="card-header" v-else>Название отсутствует</div>
                    <div class="card-body">
                        <img :src="photo.media.m">
                        <p>Автора: {{photo.author}}</p>
                        <p v-if="photo.tags != ''">Тэги: {{photo.tags}}</p>
                        <p>Опубликовано:{{photo.published.split('T').join(" ").split("Z").join()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created: function () {
           this.getPhoto();
        },
         data()  {
            return {
                selectTags: [],
                tags: [],
                photos: [],
            }
        },
        methods: {
            getTags : function(){
                axios
                .get('/tags')
                .then(function(response){
                    console.log(response.data)
                });
            },
            getPhoto : function(){
                var app = this;
                axios
                .get('/photo')
                .then(function(response){
                    console.log(response.data.data)
                    app.photos = response.data.data;
                });
            }
            
        },
    }
</script>
