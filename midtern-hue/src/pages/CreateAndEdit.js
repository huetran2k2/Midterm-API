
import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

export default function CreateAndEdit() {
  const [name, setName] = useState('');
  const [oldPrice, setOldPrice] = useState(0);
  const [price, setPrice] = useState(0);
  const [categoryId, setCategoryId] = useState('');
  const [description, setDescription] = useState('');
  const [categoryList, setCategoryList] = useState([]);

  let navigate = useNavigate();
  const [food, setFood] = useState(
    {
      image: {},
      file: {},
    },
  );
  useEffect(()=>{
    fetchDataCategory();
 },[])
 const fetchDataCategory = async ()=>{
    const res = await axios.get('http://127.0.0.1:8000/api/showcategory');
        const listCategory = await res.data;
        setCategoryList(listCategory);
 }
  const handlerImageFile = (e) => {
    setFood({
      ...food,
      file: e.target.files && e.target.files.length ? URL.createObjectURL(e.target.files[0]) : food.file,
      image: e.target.files && e.target.files.length ? e.target.files[0] : food.image,
    });
  };
  console.log(food);

  const CreateFood = (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('old_price', oldPrice);
    formData.append('description', description);
    formData.append('category_id', categoryId);
    formData.append('image', food.image);
console.log(formData);
    axios.post('http://127.0.0.1:8000/api/store', formData).then((res) => {
      alert('Đã Thêm Thành Công');
      if (res.statusText === 'OK') {
        return navigate('/');
    }
    });
  };
  return (
    <div>
      <form onSubmit={CreateFood}>
        <div className="form-group">
          <label htmlFor="exampleInputEmail1" >Name</label>
          <input type="text" className="form-control" onChange={(e) => setName(e.target.value)}/>
        </div>
        <div className="form-group">
          <label htmlFor="exampleInputEmail1" >Image</label>
          <input type="file" className="form-control" onChange={(e) => handlerImageFile(e)} />
        </div>
        <div className="form-group">
          <label htmlFor="exampleInputEmail1" >Old Price</label>
          <input type="text" className="form-control" onChange={(e) => setOldPrice(e.target.value)} />
        </div>
        <div className="form-group">
          <label htmlFor="exampleInputEmail1" >Price</label>
          <input type="text" className="form-control" onChange={(e) => setPrice(e.target.value)} />
        </div>
        <div className="form-group">
          <label htmlFor="exampleInputEmail1" >Description</label>
          <input type="text" className="form-control" onChange={(e) => setDescription(e.target.value)}/>
        </div>
        <div className="form-group">
          <label htmlFor="exampleInputEmail1">category</label>
          <select className="form-control" onChange={(e) => setCategoryId(e.target.value)}>
            {categoryList.map((category, index) => {
              return (
                <option value={category.id} key={index}>
                  {category.categories}
                </option>
              );
            })}
          </select>
        </div>
        <button type="submit" className="btn btn-primary">
          Create
        </button>
      </form>
    </div>
  )
}
