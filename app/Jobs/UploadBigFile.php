<?php

namespace App\Jobs;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadBigFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    public $file;
    public $blog;
    /**
     * Create a new job instance.
     */
    public function __construct(Blog $blog)
    {
//        $this->file = $file;
        $this->blog = $blog;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        $filename = $this->file->getClientOriginalName();
//        Storage::move($filename, 'public/img/' . $filename);
//        $this->blog->image = 'fuck';
//        $this->blog->save();
        logger('Processing blog ' . $this->blog);
    }
}



