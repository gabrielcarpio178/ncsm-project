<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Course</th>
            <th>Contact Number</th>
            
            <th>Email</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php
        $x=1;
        @endphp
        @foreach ($students as $student)
            <tr>
                <td>
                    {{$x++}}
                </td>
                <td>
                    {{ucfirst($student->fname)." ".ucfirst($student->lname)}}
                </td>
                <td>
                    {{$student->program->name}}
                </td>
                <td>
                    0{{$student->contact_number}}
                </td>
                <td>
                    {{strtoupper($student->email)}}
                </td>
                <td>
                    {{$student->created_at->format('M-d-Y')}}
                </td>
                <td>
                    {{$student->status===false?'Pending':'Accepted'}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
