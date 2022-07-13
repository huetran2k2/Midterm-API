
import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { Link } from 'react-router-dom';
export default function Count() {
    const [category, setCategory] = useState({
        list: []
    })
    const { list } = category;

    useEffect(() => {
        fetchData();
    }, [])

    const fetchData = async () => {
        const res = await axios.get('http://127.0.0.1:8000/api/count');
        const categoryList = await res.data;
        console.log(categoryList);
        setCategory({ list: categoryList, Isload: true });
    }

  return (
   
<div className='container'>
    <h2>BẢNG THỐNG KÊ</h2>
    <br/>
    {list.map((item, index) => {
        return (
            <div key={index}>
            <ul className="list-group">
             
              <li className="list-group-item d-flex justify-content-between align-items-center">
              {item.categories}
              <span className=""> {item.total}</span>
          </li>
      </ul>
          </div>
        )
    })
    }
    </div>
  )
}
