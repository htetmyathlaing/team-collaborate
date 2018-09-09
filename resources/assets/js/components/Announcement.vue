<template>
    <div class="container mt-3">
        <button type="button"
            class="btn btn-sm btn-warning btn-circle m-3"
            data-toggle="modal"
            data-placement="right" 
            title="ကြေငြာချက်တစ်ခုပြုလုပ်ရန်"
            @click="">
            <span class="fas fa-plus"></span>
        </button>
        <div class="container mt-3">
            <div class="text-center">
                <h1>Will be available soon!</h1>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                isShowed: true
            }
        },
        computed:{
            notifications(){
                return [1,2,3,4,5,6,7,8,9,10,]
            }
        }
    }
</script>
<style scoped>
    .dropdown-menu{
        overflow-y: scroll;
        max-height: 50vh;
        width: 20em !important;
    }
    .dropdown-item{
        white-space: normal !important;
    }
    .badge{
        transform: translate(10px, -30px);
        position: absolute;
    }
</style>
