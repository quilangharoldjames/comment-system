<template>
    <div class="row">
        <p v-if="comments.length == 0">
          <span>No message yet!</span>
        </p>
        <comment v-for="comment in comments" v-on="$listeners" type="comment" v-bind:comment="comment" :key="comment.id"></comment>
    </div>
</template>

<script>
    export default {
        props: ['comments']
    }
</script>
