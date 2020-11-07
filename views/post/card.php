<div class="card mb-3" >
  <div class="card-body">
    <h5 class="card-title"><?= $post->getName() ?></h5>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y H:i:s') ?></p>
    <p><?= $post->getExcerpt() ?></p>
    <p>
      <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir plus</a>
    </p>
  </div>
</div>