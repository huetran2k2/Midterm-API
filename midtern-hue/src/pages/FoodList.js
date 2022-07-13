import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { Link } from 'react-router-dom';
export default function FoodList() {
    const [food, setFood] = useState({
        listFood: []
    })
    const { listFood } = food;
    const [search, setSearch] = useState();

    useEffect(() => {
        fetchDataFood();
    }, [])
    const fetchDataFood = async () => {
        const res = await axios.get('http://127.0.0.1:8000/api/show');
        const foodList = await res.data;
        setFood({ listFood: foodList, Isload: true });
    }



    const handleSearch = async (e) => {
        const res = await axios.get(`http://127.0.0.1:8000/api/search?search=${search}`);
        console.log(res.data);
        // const carList = await res.data;
        setFood({ listFood: res.data, Isload: true });
    }
    return (
        <div className='container'>

            <label for="inputPassword" class="col-sm-2 col-form-label">Search</label>
            <div class="col-sm-10">
                <input type="text" name="search" class="form-control" id="inputPassword" onChange={(e) => setSearch(e.target.value)} />
                <button class="btn btn-info" type='button' onClick={(e) => handleSearch(e)}>Search</button>
            </div>
            <br />
            <div className='row'>
                {listFood.map((food, index) => {
                    return (
                        <div className='col-sm-3' key={index}>
                            <div className="card">
                                <img src={'http://127.0.0.1:8000/images/' + food.image} style={{ width: '250px' }} className="card-img-top" alt="..." />
                                <div className="card-body">
                                    <h5 className="card-title">{food.name}</h5>
                                    <p className="card-text">{food.price}</p>
                                    <p className="card-text">{food.description}</p>
                                    <Link to={`/edit/${food.id}`} className="btn btn-primary">Edit</Link>
                                </div>
                            </div>
                        </div>
                    )
                })
                }
            </div>
        </div>
    )








}
