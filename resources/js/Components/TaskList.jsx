import React from 'react';
import { Link } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';

export default function (props) {

  // console.log(props.id);

  const handleDeleteButton = (e) => {
    e.preventDefault();
    const data = {
      'id':props.id,
    }
    Inertia.post('/destroyTask', data)
  }

  return (
    <div className='todo'>
      <div key={props.i}>
        <div className="label">
          <span>{props.task}</span>
        </div>
        <div className="category">
          <span>Category: {props.category}</span>
        </div>
        <div className='color-grey-200'>
          <span>Created at {props.date} | {props.time}</span>
        </div>
        <div className="buttons">
          {/* Edit */}
          {/* Route's using ziggy lib */}
          <Link className="edit-button" href={route('editTask')} method='get' data={props.id} as='button'>
            Edit
          </Link>

          {/* Delete */}
          <button onClick={handleDeleteButton} className="delete-button">
            Delete
          </button>
        </div>
      </div>
    </div>
  )
};