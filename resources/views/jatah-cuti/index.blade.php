@extends('layouts.main')

@section('title', 'Jatah Cuti')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-xl font-semibold">Jatah Cuti</h2>

  <!-- Tombol Ajukan Cuti -->
  <button type="button" class="btn btn-success text-white px-4 py-2 rounded-md text-sm"
          data-bs-toggle="modal" data-bs-target="#ajukanCutiModal">
    + Ajukan Cuti
  </button>
</div>

<!-- TABEL CUTI -->
<div class="bg-white rounded-2xl shadow-md p-6">
  <table class="min-w-full text-sm text-gray-700">
    <thead>
      <tr class="border-b bg-gray-50">
        <th class="py-2 px-3 text-left">NO</th>
        <th class="py-2 px-3 text-left">Jenis Cuti</th>
        <th class="py-2 px-3 text-left">Total Sisa Cuti</th>
        <th class="py-2 px-3 text-left">Total Cuti Terpakai</th>
        <th class="py-2 px-3 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($jatahCuti as $index => $cuti)
        <tr class="border-b">
          <td class="py-2 px-3">{{ $index + 1 }}</td>
          <td class="py-2 px-3">{{ $cuti->jenis_cuti }}</td>
          <td class="py-2 px-3">{{ $cuti->sisa_cuti }} Hari</td>
          <td class="py-2 px-3">{{ $cuti->cuti_terpakai }} Hari</td>
          <td class="py-2 px-3">
            <button class="btn btn-success btn-sm">Detail</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- MODAL AJUKAN CUTI -->
<div class="modal fade" id="ajukanCutiModal" tabindex="-1" aria-labelledby="ajukanCutiLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form action="{{ route('jatah-cuti') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="ajukanCutiLabel">Form Pengajuan Cuti</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
            <select name="jenis_cuti" id="jenis_cuti" class="form-select" required>
              <option value="">-- Pilih Jenis Cuti --</option>
              <option value="Cuti Tahunan">Cuti Tahunan</option>
              <option value="Cuti Besar">Cuti Besar</option>
              <option value="Cuti Sakit">Cuti Sakit</option>
              <option value="Cuti Melahirkan">Cuti Melahirkan</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="alasan" class="form-label">Alasan</label>
            <textarea name="alasan" id="alasan" class="form-control" rows="3" placeholder="Tuliskan alasan cuti..." required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Ajukan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
