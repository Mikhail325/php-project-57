

<i class="bi bi-trash hover:text-black" data-bs-toggle="modal" data-bs-target="#taskDeleteModal"></i>
<!-- Модальное окно -->
<div class="modal fade" id="taskDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Подтвердите действие на странице</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <p>
            Вы уверены что хотите удалить задачу{{$slot}}
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Отменить</button>
        </div>
      </div>
    </div>
  </div>