
import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import { useParams } from 'react-router-dom';

export default function Edit() {
    let navigate = useNavigate();
    const { id } = useParams();
    const [categoryList, setCategoryList] = useState([]);
   
    const [food, setFood] = useState({
        name: '',
        price: '',
        old_price: '',
        image: '',
        description: '',
        category_id: '',
        file:{},

    });
    const { name, price, old_price, image, description, category_id,file } = food;

    useEffect(() => {
        fetchDataFood()
        fetchDataCategory();
    }, [])

    const fetchDataFood = async () => {
        const response = await axios.get(`http://127.0.0.1:8000/api/detail/${id}`);
        console.log(response.data.price);
        setFood((prevState) => ({
            ...prevState,
            name: response.data.name,
            price: response.data.price,
            old_price: response.data.old_price,
            image: response.data.image,
            description: response.data.description,
            category_id: response.data.category_id,
        }));
    };
    const UpdateData = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('name', name);
        formData.append('price', price);
        formData.append('old_price', old_price);
        formData.append('description', description);
        formData.append('category_id', category_id);
        formData.append('image', food.image);
        console.log(formData);

        axios.post(`http://127.0.0.1:8000/api/update/${id}`, formData).then((res) => {
            alert('Đã Cập nhật Thành Công');
            if (res.statusText === 'OK') {
                return navigate('/');
            }
        });
    };
    
    const fetchDataCategory = async () => {
        const res = await axios.get('http://127.0.0.1:8000/api/showcategory');
        const listCategory = await res.data;
        setCategoryList(listCategory);
    }

    
    const handleOnChange = (field, event) => {
        setFood((prevState) => ({
            ...prevState,
            [field]: event.target.value,
        }));
    };
   
    const onChangeImage = (event) => {
        const preImg = document.getElementById('preview-img');
        const file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = (e) => {
                const obj_url = URL.createObjectURL(file);
                preImg.setAttribute('src', obj_url);
                URL.revokeObjectURL(obj_url);
            };
        }
        setFood((previousState) => {
            return { ...previousState, file: event.target.files[0].name, image:file };
        });

    };
    console.log(image);


    return (
        <div className='container'>
            <form onSubmit={UpdateData}>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1"> Name </label>
                    <input type="text" name="name" className="form-control" value={name} onChange={(value) => handleOnChange('name', value)} />
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1"> Image </label>
                    <input type="file" className="form-control" onChange={onChangeImage} />
                    <img id="preview-img" className="img-thumbnail img-fluid" style={{ width: 200 }} src={file ? 'http://localhost:8000/images/' + file : '#'} />
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1"> Price </label>
                    <input
                        type="text"
                        name="price"
                        className="form-control"
                        value={price}
                        onChange={(value) => handleOnChange('price', value)}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1">Old  Price </label>
                    <input
                        type="text"
                        name="old_price"
                        className="form-control"
                        value={old_price}
                        onChange={(value) => handleOnChange('old_price', value)}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1"> Description </label>
                    <input
                        type="text"
                        name="price"
                        className="form-control"
                        value={description}
                        onChange={(value) => handleOnChange('description', value)}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1"> category </label>
                    <select className="form-control" onChange={(value) => handleOnChange('category_id', value)}>
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

                    Submit
                </button>
            </form>
        </div>
    )
}
