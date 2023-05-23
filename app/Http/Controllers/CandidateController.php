<?php

namespace App\Http\Controllers;

use Domain\Models\Candidate;
use Illuminate\Http\Request;
use Domain\Resources\CandidateResource;
use Domain\Repository\CandidateRepository;
use JWTAuth;


/* The CandidateController class handles requests related to candidates, including retrieving all
candidates, storing new candidates, and retrieving a specific candidate by ID. */
class CandidateController extends Controller
{
    protected $user;
   /**
    * This is a constructor function that initializes a private property with an instance of the
    * CandidateRepository class.
    * 
    * @param CandidateRepository candidateRepository This is a dependency injection in PHP. The
    *  parameter is an instance of the CandidateRepository class that is injected
    * into the constructor of the current class. This allows the current class to use the methods and
    * properties of the CandidateRepository class without having to create a new instance of it. This
    * promotes
    */
    private $candidateRepository;

    public function __construct(CandidateRepository $candidateRepository,Request $request)
    {
        $token = $request->header('Authorization');
        if($token != ''){
            
            try {
                $this->user = JWTAuth::parseToken()->authenticate();
            } catch (\Throwable $e) {
                return response()->json(['meta' => [
                    "success" =>true,
                    "error" => [ $e->getMessage()]
                ]],401);
            }
        }
        $this->candidateRepository = $candidateRepository;
    }

   /**
    * This function retrieves all candidates from the candidate repository and returns them as a
    * collection of candidate resources.
    * 
    * @return array collection of CandidateResource objects, which represent the candidates retrieved from
    * the candidate repository.
    */
    public function index()
    {
        $candidates = $this->candidateRepository->getAll();
        return CandidateResource::collection($candidates);
    }

    /**
     * This function stores a new candidate in the database with the provided data from the request.
     * 
     * @param Request request  is an instance of the Illuminate\Http\Request class which
     * represents an incoming HTTP request. It contains information about the request such as the HTTP
     * method, headers, and any data sent in the request body.
     * 
     * @return array new instance of the `CandidateResource` class, which wraps the newly created
     * `Candidate` object.
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'source', 'owner']);

        $data['created_at'] = now();
        $data['create_by'] = 1;//auth()->user()->id;
    
        $candidate = new Candidate($data);
        $candidate->save();
    
        return new CandidateResource($candidate);
    }

   /**
    * This function shows a candidate resource based on the given ID.
    * 
    * @param id The parameter `` is the unique identifier of the candidate that we want to retrieve
    * from the database. It is passed as an argument to the `show` method of the controller. The method
    * then uses this identifier to fetch the corresponding candidate record from the database using the
    * `candidateRepository` object.
    * 
    * @return array `CandidateResource` object is being returned.
    */
    public function show($id)
    {
        $candidate = $this->candidateRepository->show($id);

        return new CandidateResource($candidate);
    }
}
