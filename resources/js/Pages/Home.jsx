import React, { useState } from 'react';
import Logout from './../Components/Logout';
import TaskList from './../Components/TaskList';
import { Inertia } from '@inertiajs/inertia';

const App = (props) => {
  const maxInput = props.maxTaskInput;
  const lenData = props.data.length;
  const [value, setValue] = useState('');
  const [category, setCategory] = useState('General');

  console.log(props);

  const handleLogout = () => {
    Inertia.post('/logout');
  }

  const handleAddTask = (e) => {
    e.preventDefault();
    const data = {
      'task_description': value,
      category
    }
    Inertia.post('/storeTask', data)
    setValue('');
    setCategory('General');
  }

  // if(value >= maxInput){
  //   alert('Kepanjangan Cok')
  // }

  // Render
  return (
    <div>
      <Logout logoutHandler={handleLogout} email={props.credentials.email} />
      <div className={`app flex flex-col`}>
        <div className={`todo-list`}>
          <p className='text-2xl font-bold text-center pb-3'>
            {(props.credentials.username).toUpperCase()}  TODOS
          </p>

          <form onSubmit={handleAddTask}>
            <div className="input-container">
              <input
                type="text"
                className="input"
                value={value}
                onChange={e => setValue(e.target.value)}
                required
                maxLength={maxInput}
              />

              <select className="category-dropdown" value={category} onChange={e => setCategory(e.target.value)}>
                <option value="General">General</option>
                <option value="Office">Office</option>
                <option value="School">School</option>
                <option value="Home">Home</option>
              </select>

              <button type="submit" className="add-button">Add</button>
            </div>
            <div className=''>
              Word : {value.length}/{maxInput}
            </div>
            <div>Total Data : {lenData}</div>
          </form>

          {lenData != 0 ? props.data.map((task, i) => (
            <TaskList
              id={task.id}
              key={i}
              task={task.task_description}
              category={task.category}
              date={task.updated_at.split('T')[0]}
              time={task.updated_at.split('T')[1].split('.')[0]}
            />
          ))
            :
            <div className='todo'>
              <div>
                <div className="label text-center">
                  No Tasks Yet !!!
                </div>
              </div>
            </div>
          }
        </div>
      </div>
    </div>
  );
};

export default App;