document.addEventListener("DOMContentLoaded", function() {
    const taskForm = document.querySelector('#myTask');
    const taskList = document.querySelector('.tasksList');

    function loadTask (){
        fetch('to-do', {
            method: 'GET',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
        .then(response => response.json())
        .then(data => {
            taskList.innerHTML = '';
            data.tasks.forEach(task =>{
                const li = document.createElement("li");
                li.textContent = task.task;
                if(task.status === 'complete'){
                    li.classList.toggle('complete')
                }
                const deleteBtn = document.createElement("button");
                deleteBtn.textContent = 'Delete';
                li.appendChild(deleteBtn);
                taskList.appendChild(li);

                li.addEventListener('click', e => {
                    fetch(`updateTask/${task.id}`, {
                        method: 'POST',
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(response => response.json())
                    .then(data =>{
                        if(data.success){
                            loadTask();
                        }
                    })
                })
            })
        }).catch(err=> console.error(err));
    }





loadTask();
    })