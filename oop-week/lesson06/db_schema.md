### Схема БД

```txt
    employee
        id
        first_name
        last_name
        address
        email
        status
    
    interview
        id
        date
        first_name
        last_name
        email
        status
        employee_id NULL
    
    contract
        id
        employee_id
        first_name
        last_name
        date_open
        date_close
        close_reason
    
    position
        id
        name
    
    order
        id
        date
    
    recruit
        id
        order_id
        employee_id
        date
    
    assignment
        id
        order_id
        employee_id
        position_id
        date
        rate
        salary
        status
    
    vacation
        id
        order_id
        employee_id
        date_from
        date_to
    
    dismiss
        id
        order_id
        employee_id
        date
        reason
    
    bonus
        id
        order_id
        employee_id
        cost
    
    log
        id
        created_at
        user_id
        message
```
