<template>
    <div id="comment-form" class="card">
        <div class="card-body">
            <h3>Write a {{ type }} message</h3>
            <div v-if="this.error.message != ''" class="alert alert-danger">
              {{ this.error.message }}

              <ul>
                <li v-for="error in this.error.errors">{{ error[0] }}</li>
              </ul>
            </div>
            <div class="form-group">
                <label>Name: </label>
                <input type="text" class="form-control" v-model="reply.author" placeholder="Enter name" />
            </div>
            <div class="form-group">
                <label>{{ type | capitalize }}: </label>
                <textarea class="form-control" v-model="reply.body" rows="4"></textarea>
            </div>
            <button class="btn btn-primary form-control" v-on:click="replyTo(comment)">Submit</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['comment', 'type', 'fetchComments'],

        filters: {
          capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
          }
        },

        data() {
          return {
            reply: {
              author: '',
              body: ''
            },
            error: {
              'message': '',
              'errors': {}
            }
          }
        },

        methods: {
          replyTo(comment) {
            if (comment) {
              this.reply.parent_id = comment.id;
            }

            axios.post('/comments', this.reply)
              .then((response) => {
                this.clearCommentForm();
                this.$emit('fetchComments');
              })
              .catch((error) => {
                this.error = error.response.data;
              });
          },

          clearCommentForm() {
            this.reply = {
              author: '',
              body: ''
            }
          }
        }
    }
</script>

<style>
#comment-form {
  margin-top: 25px;
  margin-bottom: 25px;
}
</style>
