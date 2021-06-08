<template>
    <div>
        <h1>Edit Post</h1>
        <form @submit.prevent="updatePost">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Post Title:</label>
                        <input type="text" class="form-control" v-model="post.title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Post Body:</label>
                        <textarea class="form-control" v-model="post.body" rows="5"></textarea>
                    </div>
                </div>
            </div><br />
            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            post: {}
        }
    },
    methods: {
        updatePost() {
            let uri = `http://127.0.0.1:8000/api/post/update?id=${this.$route.params.id}`;
            this.axios.put(uri, this.post).then((response) => {
                this.$router.push({name: 'posts'});
            });
        }
    }
}
</script>
